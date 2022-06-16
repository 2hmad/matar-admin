<template>
    <div>
        <div class="row">
            <div class="col">
                <router-link to="/add-outlook">
                    <b-button
                        variant="outline-primary"
                        class="btn-icon"
                        style="margin-right: auto; display: block"
                    >
                        <feather-icon icon="PlusIcon" class="mr-50" />
                        <span class="align-middle">اضافة منشور</span>
                    </b-button>
                </router-link>
            </div>
            <router-link to="/comments">
                <b-button
                    variant="outline-primary"
                    class="btn-icon"
                    style="margin-right: auto; display: block"
                >
                    <feather-icon icon="MessageSquareIcon" class="mr-50" />
                    <span class="align-middle">التعليقات</span>
                </b-button>
            </router-link>
        </div>
        <br />
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

                <span v-else-if="props.column.field === 'details'">
                    <span
                        style="
                            display: -webkit-box;
                            -webkit-line-clamp: 1;
                            -webkit-box-orient: vertical;
                            overflow: hidden;
                            text-overflow: ellipsis;
                            max-width: 220px;
                        "
                    >
                        {{ props.row.details }}
                    </span>
                </span>

                <span v-else-if="props.column.field === 'action'">
                    <span>
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
                            <b-dropdown-item @click="share(props.row.id)">
                                <feather-icon icon="Share2Icon" class="mr-50" />
                                <span>مشاركة</span>
                            </b-dropdown-item>
                            <b-dropdown-item
                                :to="`/edit-outlook/${props.row.id}`"
                            >
                                <feather-icon icon="Edit2Icon" class="mr-50" />
                                <span>تعديل</span>
                            </b-dropdown-item>
                            <b-dropdown-item
                                @click="deleteOutlook(props.row.id)"
                            >
                                <feather-icon icon="TrashIcon" class="mr-50" />
                                <span>حذف</span>
                            </b-dropdown-item>
                        </b-dropdown>
                    </span>
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
        <br />
        <b-button
            variant="primary"
            style="margin-right: auto; display: block"
            @click="deleteExpired"
        >
            <feather-icon icon="TrashIcon" />
            حذف المنشورات المنتهية
        </b-button>
    </div>
</template>

<script>
import axios from "axios";
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
import FeatherIcon from "../@core/components/feather-icon/FeatherIcon.vue";
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
        FeatherIcon,
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
                    label: "نص الموضوع",
                    field: "details",
                    sortable: false,
                },
                {
                    label: "الدولة",
                    field: "country",
                    sortable: false,
                },
                {
                    label: "التاريخ والوقت",
                    field: "date",
                },
                {
                    label: "عدد الاعجابات",
                    field: "likes",
                },
                {
                    label: "عدد المشاركات",
                    field: "shares",
                },
                {
                    label: "تاريخ الاختفاء",
                    field: "hide",
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
            let response = await axios.get("/api/outlooks");
            this.rows = response.data;
        } catch (err) {
            alert("حدث خطأ ما");
        }
    },
    methods: {
        deleteOutlook(id) {
            var answer = window.confirm("هل انت متأكد من الحذف ؟");
            if (answer) {
                const config = {
                    headers: {
                        token: JSON.parse(localStorage.getItem("MatarAdmin"))
                            .token,
                    },
                };
                axios
                    .post(
                        "/api/admin/delete-outlook",
                        {
                            id: id,
                        },
                        config
                    )
                    .then((result) => {
                        alert("تم حذف التوقع"), location.reload();
                    })
                    .catch((err) => {
                        alert("حدث خطأ ما");
                    });
            }
        },
        share(id) {
            var copyText = "https://rain-app.com/post/" + id;
            navigator.clipboard.writeText(copyText);
            alert("تم نسخ رابط المشاركة");
        },
        deleteExpired() {
            var answer = window.confirm("هل انت متأكد من العملية ؟");
            if (answer) {
                axios
                    .post(
                        "/api/admin/delete-unused",
                        {},
                        {
                            headers: {
                                token: JSON.parse(
                                    localStorage.getItem("MatarAdmin")
                                ).token,
                            },
                        }
                    )
                    .then((result) => {
                        alert("تم حذف التوقعات المنتهية"), location.reload();
                    })
                    .catch((err) => {
                        alert("حدث خطأ ما");
                    });
            }
        },
    },
};
</script>

<style></style>
