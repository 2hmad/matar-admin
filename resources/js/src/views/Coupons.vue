<template>
    <div>
        <b-button
            variant="outline-primary"
            class="btn-icon"
            style="margin-right: auto; display: block"
            v-b-modal.modal-center
        >
            <feather-icon icon="PlusIcon" class="mr-50" />
            <span class="align-middle">اضافة</span>
        </b-button>
        <b-modal id="modal-center" centered title="اضافة كوبون" hide-footer>
            <b-card-text>
                <b-form @submit.prevent="addCoupon">
                    <b-form-group label="الكوبون" label-for="v-title">
                        <b-form-input
                            id="v-title"
                            placeholder="الكوبون"
                            v-model="form.coupon"
                        />
                    </b-form-group>
                    <b-form-group label="الدولة" label-for="v-country">
                        <b-form-select id="v-country" v-model="form.country">
                            <option value="">العامة</option>
                            <option>عمان</option>
                            <option>الأمارات</option>
                            <option>السعودية</option>
                            <option>قطر</option>
                            <option>البحرين</option>
                            <option>الكويت</option>
                            <option>اليمن</option>
                            <option>العراق</option>
                            <option>الاردن</option>
                            <option>لبنان</option>
                            <option>سوريا</option>
                            <option>فلسطين</option>
                            <option>تونس</option>
                            <option>ليبيا</option>
                            <option>مصر</option>
                            <option>السودان</option>
                            <option>المغرب</option>
                            <option>الجزائر</option>
                            <option>موريتانيا</option>
                        </b-form-select>
                    </b-form-group>
                    <b-form-group
                        label="مدة الغاء الاعلانات (بالايام)"
                        label-for="v-duration"
                    >
                        <b-form-input
                            class="form-control"
                            type="number"
                            min="1"
                            id="v-duration"
                            v-model="form.days"
                        />
                    </b-form-group>
                    <b-form-group label="مدة الانتهاء" label-for="v-date">
                        <flat-pickr
                            class="form-control"
                            id="v-date"
                            :config="{
                                dateFormat: 'Y-m-d',
                            }"
                            v-model="form.expire_date"
                        />
                    </b-form-group>
                    <b-button type="submit" variant="primary" class="w-100">
                        اضافة
                    </b-button>
                </b-form>
            </b-card-text>
        </b-modal>
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

                <span v-else-if="props.column.field === 'used_by'">
                    <span>
                        {{ props.row.used_by.length }}
                    </span>
                </span>

                <span v-else-if="props.column.field === 'action'">
                    <span>
                        <b-button
                            variant="flat-success"
                            class="btn-icon rounded-circle"
                            v-b-modal="`used-by-${props.row.id}`"
                        >
                            <feather-icon
                                icon="EyeIcon"
                                size="16"
                                class="text-body"
                            />
                        </b-button>
                        <b-modal
                            :id="`used-by-${props.row.id}`"
                            centered
                            title="تفاصيل الكوبون"
                            hide-footer
                        >
                            <b-card-text>
                                <h5>المستخدمين :</h5>
                                <b-list-group>
                                    <b-list-group-item
                                        v-for="user in props.row.used_by"
                                        :key="user.id"
                                    >
                                        {{ user.u_name }}
                                    </b-list-group-item>
                                </b-list-group>
                            </b-card-text>
                        </b-modal>
                    </span>
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
                            <b-dropdown-item
                                v-if="props.row.active == 1"
                                @click="disableCoupon(props.row.id)"
                            >
                                <feather-icon
                                    icon="StopCircleIcon"
                                    class="mr-50"
                                />
                                <span>تعطيل</span>
                            </b-dropdown-item>
                            <b-dropdown-item
                                v-else
                                @click="enableCoupon(props.row.id)"
                            >
                                <feather-icon
                                    icon="StopCircleIcon"
                                    class="mr-50"
                                />
                                <span>تفعيل</span>
                            </b-dropdown-item>
                            <b-dropdown-item
                                :to="`/edit-coupon/${props.row.id}`"
                            >
                                <feather-icon icon="Edit2Icon" class="mr-50" />
                                <span>تعديل</span>
                            </b-dropdown-item>
                            <b-dropdown-item
                                @click="deleteCoupon(props.row.id)"
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
    BFormFile,
    BListGroup,
    BListGroupItem,
    BForm,
} from "bootstrap-vue";
import { VueGoodTable } from "vue-good-table";
import flatPickr from "vue-flatpickr-component";
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
        BFormFile,
        BListGroup,
        BListGroupItem,
        flatPickr,
        BForm,
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
                    label: "الكوبون",
                    field: "coupon",
                    sortable: false,
                },
                {
                    label: "عدد المستخدمين",
                    field: "used_by",
                    sortable: false,
                },
                {
                    label: "تاريخ الانتهاء",
                    field: "expire_date",
                    sortable: false,
                },
                {
                    label: "مدة الغاء الاعلانات",
                    field: "days",
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
            countries: [],
            form: {
                coupon: "",
                country: "",
                days: null,
                expire_date: "",
            },
        };
    },
    async mounted() {
        try {
            let response = await axios.get("/api/countries");
            this.countries = response.data;
            let coupons = await axios.get("/api/coupons");
            this.rows = coupons.data;
        } catch (err) {
            console.log(err);
        }
    },
    methods: {
        addCoupon() {
            axios
                .post("/api/admin/add-coupon", this.form, {
                    headers: {
                        token: JSON.parse(localStorage.getItem("MatarAdmin"))
                            .token,
                    },
                })
                .then((res) => {
                    alert("تم اضافة الكوبون");
                    location.reload();
                })
                .catch((err) => console.log(err));
        },
        disableCoupon(id) {
            axios
                .post(
                    "/api/admin/disable-coupon",
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
                    alert("تم تعطيل الكوبون");
                    location.reload();
                })
                .catch((err) => console.log(err));
        },
        enableCoupon(id) {
            axios
                .post(
                    "/api/admin/enable-coupon",
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
                    alert("تم تفعيل الكوبون");
                    location.reload();
                })
                .catch((err) => console.log(err));
        },
        deleteCoupon(id) {
            var confirm = window.confirm("هل انت متأكد من الحذف ؟");
            if (confirm) {
                axios
                    .post(
                        "/api/admin/delete-coupon",
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
                        alert("تم حذف الكوبون");
                        location.reload();
                    })
                    .catch((err) => console.log(err));
            }
        },
    },
};
</script>

<style lang="scss">
@import "@core/scss/vue/libs/vue-flatpicker.scss";
</style>
