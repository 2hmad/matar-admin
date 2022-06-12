<template>
    <div>
        <div class="custom-search d-flex justify-content-start">
            <b-form-group>
                <div class="d-flex align-items-center">
                    <b-form-input
                        v-model="searchTerm"
                        placeholder="بحث"
                        type="text"
                        class="d-inline-block"
                    />
                </div>
            </b-form-group>
        </div>

        <!-- table -->
        <vue-good-table
            :columns="columns"
            :rows="rows"
            :search-options="{
                enabled: true,
                externalQuery: searchTerm,
            }"
            :pagination-options="{
                enabled: true,
                perPage: pageLength,
            }"
        >
            <div slot="emptystate">لا توجد بيانات</div>
            <template slot="table-row" slot-scope="props">
                <span
                    v-if="props.column.field === 'fullName'"
                    class="text-nowrap"
                >
                    <span class="text-nowrap">{{ props.row.fullName }}</span>
                </span>

                <span v-else-if="props.column.field === 'action'">
                    <span>
                        <a
                            :href="`/storage/weather-shots/${props.row.media}`"
                            target="_blank"
                        >
                            <b-button
                                variant="flat-success"
                                class="btn-icon rounded-circle"
                            >
                                <feather-icon
                                    icon="EyeIcon"
                                    size="16"
                                    class="text-body"
                                />
                            </b-button>
                        </a>
                    </span>

                    <b-dropdown
                        variant="link"
                        toggle-class="text-decoration-none"
                        no-caret
                    >
                        <template v-slot:button-content>
                            <feather-icon
                                icon="MoreVerticalIcon"
                                size="16"
                                class="text-body"
                            />
                        </template>
                        <b-dropdown-item
                            :to="`/storage/weather-shots/${props.row.media}`"
                            target="_blank"
                            download
                        >
                            <feather-icon
                                icon="DownloadCloudIcon"
                                class="mr-50"
                            />
                            <span>تحميل الوسائط</span>
                        </b-dropdown-item>
                        <b-dropdown-item @click="acceptShot(props.row.id)">
                            <feather-icon icon="CheckIcon" class="mr-50" />
                            <span>موافقة</span>
                        </b-dropdown-item>
                        <b-dropdown-item @click="rejectShot(props.row.id)">
                            <feather-icon icon="XIcon" class="mr-50" />
                            <span>رفض</span>
                        </b-dropdown-item>
                        <b-dropdown-item @click="deleteShot(props.row.id)">
                            <feather-icon icon="TrashIcon" class="mr-50" />
                            <span>حذف</span>
                        </b-dropdown-item>
                    </b-dropdown>
                </span>

                <!-- Column: Common -->
                <span v-else>
                    {{ props.formattedRow[props.column.field] }}
                </span>
            </template>

            <!-- pagination -->
            <template slot="pagination-bottom" slot-scope="props">
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="d-flex align-items-center mb-0 mt-1">
                        <span class="text-nowrap"> اظهار 1 الي </span>
                        <b-form-select
                            v-model="pageLength"
                            :options="['3', '5', '10']"
                            class="mx-1"
                            @input="
                                (value) =>
                                    props.perPageChanged({
                                        currentPerPage: value,
                                    })
                            "
                        />
                        <span class="text-nowrap">
                            من {{ props.total }} صف
                        </span>
                    </div>
                    <div>
                        <b-pagination
                            :value="1"
                            :total-rows="props.total"
                            :per-page="pageLength"
                            first-number
                            last-number
                            align="right"
                            class="mt-1 mb-0"
                            @input="
                                (value) =>
                                    props.pageChanged({ currentPage: value })
                            "
                        >
                            <template #prev-text>
                                <feather-icon
                                    icon="ChevronLeftIcon"
                                    size="18"
                                />
                            </template>
                            <template #next-text>
                                <feather-icon
                                    icon="ChevronRightIcon"
                                    size="18"
                                />
                            </template>
                        </b-pagination>
                    </div>
                </div>
            </template>
        </vue-good-table>
    </div>
</template>

<script>
import {
    BButton,
    BAvatar,
    BBadge,
    BPagination,
    BFormGroup,
    BFormInput,
    BFormSelect,
    BDropdown,
    BDropdownItem,
} from "bootstrap-vue";
import { VueGoodTable } from "vue-good-table";
import axios from "axios";
export default {
    components: {
        BButton,
        BAvatar,
        BBadge,
        BPagination,
        BFormGroup,
        BFormInput,
        BFormSelect,
        BDropdown,
        BDropdownItem,
        VueGoodTable,
    },
    data() {
        return {
            pageLength: 15,
            dir: false,
            columns: [
                {
                    label: "#",
                    field: "id",
                    hidden: true,
                },
                {
                    label: "اسم المستخدم",
                    field: "user.name",
                    sortable: false,
                },
                {
                    label: "اسم المصور",
                    field: "photographer",
                    sortable: false,
                },
                {
                    label: "الموقع",
                    field: "location",
                    sortable: false,
                },
                {
                    label: "تاريخ الارسال",
                    field: "send_date",
                    sortable: false,
                },
                {
                    label: "التاريخ والوقت",
                    field: "date",
                    sortable: false,
                },
                {
                    label: "الاعدادات",
                    field: "action",
                    sortable: false,
                },
            ],
            rows: [],
            searchTerm: "",
        };
    },
    async mounted() {
        try {
            let response = await axios.get("/api/pending-shots");
            this.rows = response.data;
        } catch (err) {
            alert("حدث خطأ ما");
        }
    },
    methods: {
        deleteShot(id) {
            var confirm = window.confirm("هل انت متأكد من الحذف");
            if (confirm) {
                axios
                    .post(
                        "/api/admin/delete-pending-weathershot",
                        {
                            id: id,
                        },
                        {
                            headers: {
                                token: JSON.parse(
                                    localStorage.getItem("MatarAdmin")
                                ).token,
                            },
                        }
                    )
                    .then((res) => {
                        alert("تم الحذف بنجاح"), location.reload();
                    })
                    .catch((err) => console.log(err));
            }
        },
        acceptShot(id) {
            var confirm = window.confirm("هل انت متأكد من القبول ؟");
            if (confirm) {
                axios
                    .post(
                        "/api/admin/accept-pending-shot",
                        {
                            post_id: id,
                        },
                        {
                            headers: {
                                token: JSON.parse(
                                    localStorage.getItem("MatarAdmin")
                                ).token,
                            },
                        }
                    )
                    .then((res) => {
                        alert("تم القبول بنجاح ونقلها للعامة"),
                            location.reload();
                    })
                    .catch((err) => console.log(err));
            }
        },
        rejectShot(id) {
            var confirm = window.confirm("هل انت متأكد من الرفض ؟");
            if (confirm) {
                axios
                    .post(
                        "/api/admin/reject-pending-shot",
                        {
                            post_id: id,
                        },
                        {
                            headers: {
                                token: JSON.parse(
                                    localStorage.getItem("MatarAdmin")
                                ).token,
                            },
                        }
                    )
                    .then((res) => {
                        alert("تم رفض الطلب وارسال اشعار للمستخدم"),
                            location.reload();
                    })
                    .catch((err) => console.log(err));
            }
        },
    },
};
</script>

<style>
.vgt-checkbox-col {
    display: none;
}
.vgt-left-align {
    width: 200px;
    max-width: 200px;
    min-height: 200px;
}
.vgt-left-align span {
    width: 100%;
    height: 100%;
}
</style>
