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
            :rtl="dir"
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
                        <!-- <b-dropdown-item
                            @click="blockAdmin(props.row.id)"
                            v-if="props.row.ban === 0"
                        >
                            <feather-icon icon="StopCircleIcon" class="mr-50" />
                            <span>حظر</span>
                        </b-dropdown-item>
                        <b-dropdown-item
                            @click="unblockAdmin(props.row.id)"
                            v-else
                        >
                            <feather-icon icon="StopCircleIcon" class="mr-50" />
                            <span>رفع الحظر</span>
                        </b-dropdown-item> -->
                        <b-dropdown-item @click="deleteAdmin(props.row.id)">
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
import moment from "moment";
import {
    BFormGroup,
    BFormInput,
    BBadge,
    BPagination,
    BFormSelect,
    BDropdown,
    BDropdownItem,
    BButton,
    BSidebar,
    VBToggle,
    BForm,
} from "bootstrap-vue";
import { VueGoodTable } from "vue-good-table";
import axios from "axios";
export default {
    components: {
        BBadge,
        BFormGroup,
        BFormInput,
        VueGoodTable,
        moment,
        BPagination,
        BFormSelect,
        BDropdown,
        BDropdownItem,
        BButton,
        BSidebar,
        VBToggle,
        BForm,
    },
    directives: {
        "b-toggle": VBToggle,
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
                    label: "الاسم",
                    field: "name",
                    sortable: false,
                },
                {
                    label: "البريد الالكتروني",
                    field: "email",
                    sortable: false,
                },
                {
                    label: "الدولة",
                    field: "country",
                    sortable: false,
                },
                {
                    label: "رقم الهاتف",
                    field: "phone",
                    sortable: false,
                },
                {
                    label: "تاريخ التسجيل",
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
            let response = await axios.post(
                "/api/admin/users",
                {},
                {
                    headers: {
                        token: JSON.parse(localStorage.getItem("MatarAdmin"))
                            .token,
                    },
                }
            );
            this.rows = response.data;
        } catch (err) {
            alert("حدث خطأ ما");
        }
    },
    methods: {
        blockAdmin(id) {
            let confirm = window.confirm("هل انت متأكد ؟");
            if (confirm) {
                axios
                    .post(
                        "/api/admin/block-admin",
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
                        alert("تم حظر المستخدم");
                        location.reload();
                    })
                    .catch((err) => {
                        alert("حدث خطأ ما");
                    });
            }
        },
        unblockAdmin(id) {
            let confirm = window.confirm("هل انت متأكد ؟");
            if (confirm) {
                axios
                    .post(
                        "/api/admin/unblock-admin",
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
                        alert("تم رفع حظر المستخدم");
                        location.reload();
                    })
                    .catch((err) => {
                        alert("حدث خطأ ما");
                    });
            }
        },
        deleteAdmin(id) {
            let confirm = window.confirm("هل انت متأكد ؟");
            if (confirm) {
                axios
                    .post(
                        "/api/admin/delete-user",
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
                        alert("تم حذف المستخدم");
                        location.reload();
                    })
                    .catch((err) => {
                        alert("حدث خطأ ما");
                    });
            }
        },
    },
};
</script>
