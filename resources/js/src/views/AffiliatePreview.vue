<template>
    <div>
        <b-button
            variant="primary"
            v-b-modal="`modal-marketer`"
            style="margin-right: auto; display: block"
        >
            بيانات المسوق
        </b-button>
        <br /><br />
        <b-modal
            :id="`modal-marketer`"
            centered
            title="بيانات المسوق"
            hide-footer
        >
            <b-card-text>
                <div style="line-height: 2.9rem">
                    <div>
                        <span style="font-weight: bold">الاسم : </span>
                        <span>{{ marketer_data.full_name }}</span>
                    </div>
                    <div>
                        <span style="font-weight: bold">
                            البريد الالكتروني :
                        </span>
                        <span>{{ marketer_data.email }}</span>
                    </div>
                    <div>
                        <span style="font-weight: bold">رقم الهاتف : </span>
                        <span>{{ marketer_data.phone }}</span>
                    </div>
                    <div>
                        <span style="font-weight: bold">العنوان : </span>
                        <span>{{ marketer_data.address }}</span>
                    </div>
                    <div>
                        <span style="font-weight: bold">الدولة : </span>
                        <span>{{ marketer_data.country }}</span>
                    </div>
                    <div>
                        <span style="font-weight: bold">الكوبون : </span>
                        <span>{{ marketer_data.coupon }}</span>
                    </div>
                    <div>
                        <span style="font-weight: bold">
                            حسابات السوشيال ميديا :
                        </span>
                        <br />
                        <a
                            :href="marketer_data.facebook_acc"
                            v-if="marketer_data.facebook_acc !== null"
                        >
                            <img
                                src="https://img.icons8.com/color/35/000000/facebook-new.png"
                            />
                        </a>
                        <a
                            :href="marketer_data.instagram_acc"
                            v-if="marketer_data.instagram_acc !== null"
                        >
                            <img
                                src="https://img.icons8.com/color/35/000000/instagram-new.png"
                            />
                        </a>
                        <a
                            :href="marketer_data.twitter_acc"
                            v-if="marketer_data.twitter_acc !== null"
                        >
                            <img
                                src="https://img.icons8.com/color/35/000000/twitter--v1.png"
                            />
                        </a>
                        <a
                            :href="marketer_data.tiktok_acc"
                            v-if="marketer_data.tiktok_acc !== null"
                        >
                            <img
                                src="https://img.icons8.com/color/35/000000/tiktok--v1.png"
                            />
                        </a>
                    </div>
                </div>
            </b-card-text>
        </b-modal>
        <div class="row">
            <div class="col-lg">
                <div class="card">
                    <div
                        class="card-body d-flex justify-content-between align-items-center"
                    >
                        <div class="truncate">
                            <h2 class="mb-25 font-weight-bolder">
                                {{
                                    marketer_funds.reduce(
                                        (prev, curr) => prev + curr.amount,
                                        0
                                    )
                                }}$
                            </h2>
                            <span>اجمالي الايرادات</span>
                        </div>
                        <b-button
                            variant="success"
                            style="margin-right: auto; display: block"
                            @click="withdraw(marketer_data.id)"
                        >
                            سحب
                        </b-button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                <div class="card">
                    <div
                        class="card-body d-flex justify-content-between align-items-center"
                    >
                        <div class="truncate">
                            <h2 class="mb-25 font-weight-bolder">
                                {{ marketer_data.details.length }}
                            </h2>
                            <span>عدد المسجلين عبر المسوق</span>
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
                                    marketer_reg.reduce(
                                        (prev, curr) => prev + curr.amount,
                                        0
                                    )
                                }}$
                            </h2>
                            <span>اجمالي عمولة التسجيل</span>
                        </div>
                        <span
                            class="b-avatar badge-light-success rounded-circle"
                            style="width: 45px; height: 45px"
                        >
                            <span class="b-avatar-custom">
                                <feather-icon icon="UserIcon" size="22" />
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
                                    marketer_sub.reduce(
                                        (prev, curr) => prev + curr.amount,
                                        0
                                    )
                                }}$
                            </h2>
                            <span>اجمالي عمولة الاشتراك</span>
                        </div>
                        <span
                            class="b-avatar badge-light-primary rounded-circle"
                            style="width: 45px; height: 45px"
                        >
                            <span class="b-avatar-custom">
                                <feather-icon icon="CloudIcon" size="22" />
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <h4>اخر الدفعات المستلمة</h4>
        <vue-good-table
            :columns="paymentsColumns"
            :rows="paymentsRows"
            :search-options="{
                enabled: true,
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

                <span v-else-if="props.column.field === 'method'">
                    <span v-if="props.row.method === 'register'"> تسجيل </span>
                    <span v-else> الاشتراك </span>
                </span>

                <span v-else-if="props.column.field === 'action'">
                    <span>
                        <router-link :to="`/outlook/${props.row.id}`">
                            <feather-icon
                                icon="EyeIcon"
                                size="16"
                                class="text-body"
                            />
                        </router-link>
                    </span>
                </span>

                <!-- Column: Common -->
                <span v-else>
                    {{ props.formattedRow[props.column.field] }}
                </span>
            </template>
        </vue-good-table>

        <br />

        <!-- <h4>عمليات السحب</h4>
        <vue-good-table
            :columns="withdrawColumns"
            :rows="withdrawRows"
            :search-options="{
                enabled: true,
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
                        <b-button
                            variant="flat-success"
                            class="btn-icon rounded-circle"
                            v-b-modal="`modal-withdraw-${props.row.id}`"
                        >
                            <feather-icon
                                icon="EyeIcon"
                                size="16"
                                class="text-body"
                            />
                        </b-button>
                    </span>
                    <b-modal
                        :id="`modal-withdraw-${props.row.id}`"
                        centered
                        title="تفاصيل العملية"
                        hide-footer
                    >
                        <b-card-text>
                            <h5>المبلغ</h5>
                            <p>20$</p>
                            <h5>طريقة السحب</h5>
                            <p>Paypal</p>
                            <h5>بيانات الحساب</h5>
                            <p>ahmed_noreldin@outlook.com</p>
                            <b-button variant="primary" class="w-100">
                                تأكيد السحب وتصفير الحساب
                            </b-button>
                        </b-card-text>
                    </b-modal>
                </span>

        <span v-else>
                    {{ props.formattedRow[props.column.field] }}
                </span>
            </template>
        </vue-good-table>

        <br />
        -->

        <h4>المستخدمين</h4>
        <vue-good-table
            :columns="usersColumns"
            :rows="usersRows"
            :search-options="{
                enabled: true,
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
                        <router-link :to="`/outlook/${props.row.id}`">
                            <feather-icon
                                icon="EyeIcon"
                                size="16"
                                class="text-body"
                            />
                        </router-link>
                    </span>
                </span>

                <!-- Column: Common -->
                <span v-else>
                    {{ props.formattedRow[props.column.field] }}
                </span>
            </template>
        </vue-good-table>
    </div>
</template>

<script>
import { VueGoodTable } from "vue-good-table";
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
    BFormFile,
    BCardText,
} from "bootstrap-vue";
import axios from "axios";
export default {
    components: {
        VueGoodTable,
        BButton,
        BAvatar,
        BBadge,
        BPagination,
        BFormGroup,
        BFormInput,
        BFormSelect,
        BDropdown,
        BDropdownItem,
        BFormFile,
        BCardText,
    },
    data() {
        return {
            pageLength: 5,
            dir: false,
            paymentsColumns: [
                {
                    label: "#",
                    field: "id",
                    hidden: true,
                },
                {
                    label: "طريقة التحصيل",
                    field: "method",
                    sortable: false,
                },
                {
                    label: "تاريخ التحصيل",
                    field: "date",
                    sortable: false,
                },
                {
                    label: "المبلغ",
                    field: "amount",
                },
            ],
            paymentsRows: [],
            // withdrawColumns: [
            //     {
            //         label: "#",
            //         field: "id",
            //         hidden: true,
            //     },
            //     {
            //         label: "المبلغ",
            //         field: "amount",
            //         sortable: false,
            //     },
            //     {
            //         label: "طريقة السحب",
            //         field: "method",
            //         sortable: false,
            //     },
            //     {
            //         label: "تاريخ العملية",
            //         field: "date",
            //     },
            //     {
            //         label: "الاعدادات",
            //         field: "action",
            //         sortable: false,
            //     },
            // ],
            // withdrawRows: [],
            usersColumns: [
                {
                    label: "#",
                    field: "id",
                    hidden: true,
                },
                {
                    label: "اسم المستخدم",
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
                },
            ],
            usersRows: [],

            marketer_data: [],
            marketer_funds: [],
            marketer_reg: [],
            marketer_sub: [],
        };
    },
    async mounted() {
        try {
            let marketer = await axios.post(
                `/api/admin/marketer/${this.$route.params.id}`,
                {},
                {
                    headers: {
                        token: JSON.parse(localStorage.getItem("MatarAdmin"))
                            .token,
                    },
                }
            );
            this.marketer_data = marketer.data;
            this.marketer_funds = marketer.data.details;
            this.marketer_reg = marketer.data.details.filter(
                (item) => item.type === "register"
            );
            this.marketer_sub = marketer.data.details.filter(
                (item) => item.type === "subscribe"
            );
            this.paymentsRows = marketer.data.details;
            this.usersRows = marketer.data.details;
        } catch (err) {
            console.log(err);
        }
    },
    methods: {
        withdraw(id) {
            let confirm = window.confirm("هل انت متأكد من هذا الاجراء ؟");
            if (confirm) {
                axios
                    .post(
                        "/api/admin/withdraw-marketer",
                        { id: id },
                        {
                            headers: {
                                token: JSON.parse(
                                    localStorage.getItem("MatarAdmin")
                                ).token,
                            },
                        }
                    )
                    .then((res) => {
                        alert("تم اجراء السحب وتصفير الايرادات"),
                            location.reload();
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            }
        },
    },
};
</script>

<style></style>
