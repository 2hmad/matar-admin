<template>
    <div>
        <div class="row">
            <div class="col-lg">
                <div class="card">
                    <div
                        class="card-body d-flex justify-content-between align-items-center"
                    >
                        <div class="truncate">
                            <h2 class="mb-25 font-weight-bolder">
                                {{
                                    rows.filter((item) => item.active == 1)
                                        .length
                                }}
                            </h2>
                            <span>عدد المشتركين الحاليين</span>
                        </div>
                        <span
                            class="b-avatar badge-light-primary rounded-circle"
                            style="width: 45px; height: 45px"
                        >
                            <span class="b-avatar-custom">
                                <feather-icon icon="UsersIcon" size="22" />
                            </span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card">
                    <div
                        class="card-body d-flex justify-content-between align-items-center"
                    >
                        <div class="truncate">
                            <h2 class="mb-25 font-weight-bolder">
                                {{
                                    rows.filter((item) => item.active == 0)
                                        .length
                                }}
                            </h2>
                            <span>عدد المشتركين المنتهيين</span>
                        </div>
                        <span
                            class="b-avatar badge-light-danger rounded-circle"
                            style="width: 45px; height: 45px"
                        >
                            <span class="b-avatar-custom">
                                <feather-icon icon="UserXIcon" size="22" />
                            </span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card">
                    <div
                        class="card-body d-flex justify-content-between align-items-center"
                    >
                        <div class="truncate">
                            <h2 class="mb-25 font-weight-bolder">
                                {{
                                    rows.reduce(
                                        (prev, curr) =>
                                            parseInt(prev) +
                                            parseInt(curr.amount),
                                        0
                                    )
                                }}$
                            </h2>
                            <span>الايرادات</span>
                        </div>
                        <span
                            class="b-avatar badge-light-success rounded-circle"
                            style="width: 45px; height: 45px"
                        >
                            <span class="b-avatar-custom">
                                <feather-icon icon="DollarSignIcon" size="22" />
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
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

                <span v-else-if="props.column.field === 'amount'">
                    {{ props.row.amount }}$
                </span>

                <span v-else-if="props.column.field === 'status'">
                    <b-badge
                        variant="light-success"
                        v-if="props.row.expire_date >= currentDate()"
                    >
                        فعال
                    </b-badge>
                    <b-badge variant="light-danger" v-else> غير فعال </b-badge>
                </span>

                <span v-else-if="props.column.field === 'action'">
                    <span>
                        <b-button
                            variant="flat-success"
                            class="btn-icon rounded-circle"
                            v-b-modal="`modal-subscriber-${props.row.id}`"
                        >
                            <feather-icon
                                icon="EyeIcon"
                                size="16"
                                class="text-body"
                            />
                        </b-button>
                    </span>
                    <b-modal
                        :id="`modal-subscriber-${props.row.id}`"
                        centered
                        title="تفاصيل الاشتراك"
                        hide-footer
                    >
                        <b-card-text>
                            <p>
                                <span style="font-weight: bold">
                                    تاريخ الاشتراك :
                                </span>
                                <span>{{ props.row.start_date }}</span>
                            </p>
                            <p>
                                <span style="font-weight: bold">
                                    تاريخ الانتهاء :
                                </span>
                                <span>{{ props.row.expire_date }}</span>
                            </p>
                            <p>
                                <span style="font-weight: bold">
                                    عبر مسوق :
                                </span>
                                <span v-if="props.row.marketer_name !== null">
                                    نعم
                                </span>
                                <span v-else> لا </span>
                            </p>
                            <p v-if="props.row.marketer_name !== null">
                                <span style="font-weight: bold">
                                    اسم المسوق :
                                </span>
                                <span>احمد محمد</span>
                            </p>
                            <p>
                                <span style="font-weight: bold">
                                    طريقة الدفع :
                                </span>
                                <span>
                                    {{ props.row.pay_method }}
                                </span>
                            </p>
                        </b-card-text>
                    </b-modal>
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
                        <b-dropdown-item @click="cancel(props.row.id)">
                            <feather-icon icon="XOctagonIcon" class="mr-50" />
                            <span>الغاء الاشتراك</span>
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
                    label: "البريد الالكتروني",
                    field: "user.email",
                    sortable: false,
                },
                {
                    label: "الدولة",
                    field: "user.country",
                    sortable: false,
                },
                {
                    label: "تاريخ الاشتراك",
                    field: "start_date",
                    sortable: false,
                },
                {
                    label: "تاريخ الانتهاء",
                    field: "expire_date",
                    sortable: false,
                },
                {
                    label: "قيمة الاشتراك",
                    field: "amount",
                    sortable: false,
                },
                {
                    label: "الحالة",
                    field: "status",
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
    methods: {
        cancel(id) {
            axios
                .delete(`/api/admin/subscriptions/${id}`, {
                    headers: {
                        token: JSON.parse(localStorage.getItem("MatarAdmin"))
                            .token,
                    },
                })
                .then((res) => {
                    alert("تم الغاء الاشتراك بنجاح");
                    this.rows = this.rows.filter((row) => row.id != id);
                })
                .catch((err) => {
                    alert("حدث خطأ ما");
                });
        },
        currentDate() {
            return moment().format("YYYY-MM-DD");
        },
    },
    async mounted() {
        try {
            let response = await axios.post(
                "/api/admin/subscriptions",
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
};
</script>
