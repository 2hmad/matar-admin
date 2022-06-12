<template>
    <div>
        <b-button
            variant="outline-primary"
            class="btn-icon"
            style="margin-right: auto; display: block"
            v-b-toggle.sidebar-right
        >
            <feather-icon icon="PlusIcon" class="mr-50" />
            <span class="align-middle">اضافة مستخدم</span>
        </b-button>
        <b-sidebar id="sidebar-right" bg-variant="white" backdrop shadow>
            <b-form class="p-2" @submit.prevent="addAdmin">
                <b-form-group label="الاسم" label-for="name">
                    <b-form-input
                        type="text"
                        placeholder="الاسم"
                        id="name"
                        v-model="form.name"
                    />
                </b-form-group>
                <b-form-group label="البريد الالكتروني" label-for="email">
                    <b-form-input
                        type="email"
                        placeholder="البريد الالكتروني"
                        id="email"
                        v-model="form.email"
                    />
                </b-form-group>
                <b-form-group label="كلمة المرور" label-for="password">
                    <b-form-input
                        type="password"
                        placeholder="كلمة المرور"
                        id="password"
                        v-model="form.password"
                    />
                </b-form-group>
                <b-form-group label="الدولة" label-for="country">
                    <b-form-select id="country" v-model="form.country">
                        <option value="أفغانستان">أفغانستان</option>
                        <option value="ألبانيا">ألبانيا</option>
                        <option value="الجزائر">الجزائر</option>
                        <option value="أندورا">أندورا</option>
                        <option value="أنغولا">أنغولا</option>
                        <option value="أنتيغوا وباربودا">
                            أنتيغوا وباربودا
                        </option>
                        <option value="الأرجنتين">الأرجنتين</option>
                        <option value="أرمينيا">أرمينيا</option>
                        <option value="أستراليا">أستراليا</option>
                        <option value="النمسا">النمسا</option>
                        <option value="أذربيجان">أذربيجان</option>
                        <option value="البهاما">البهاما</option>
                        <option value="البحرين">البحرين</option>
                        <option value="بنغلاديش">بنغلاديش</option>
                        <option value="باربادوس">باربادوس</option>
                        <option value="بيلاروسيا">بيلاروسيا</option>
                        <option value="بلجيكا">بلجيكا</option>
                        <option value="بليز">بليز</option>
                        <option value="بنين">بنين</option>
                        <option value="بوتان">بوتان</option>
                        <option value="بوليفيا">بوليفيا</option>
                        <option value="البوسنة والهرسك ">
                            البوسنة والهرسك
                        </option>
                        <option value="بوتسوانا">بوتسوانا</option>
                        <option value="البرازيل">البرازيل</option>
                        <option value="بروناي">بروناي</option>
                        <option value="بلغاريا">بلغاريا</option>
                        <option value="بوركينا فاسو ">بوركينا فاسو</option>
                        <option value="بوروندي">بوروندي</option>
                        <option value="كمبوديا">كمبوديا</option>
                        <option value="الكاميرون">الكاميرون</option>
                        <option value="كندا">كندا</option>
                        <option value="الرأس الأخضر">الرأس الأخضر</option>
                        <option value="جمهورية أفريقيا الوسطى ">
                            جمهورية أفريقيا الوسطى
                        </option>
                        <option value="تشاد">تشاد</option>
                        <option value="تشيلي">تشيلي</option>
                        <option value="الصين">الصين</option>
                        <option value="كولومبيا">كولومبيا</option>
                        <option value="جزر القمر">جزر القمر</option>
                        <option value="كوستاريكا">كوستاريكا</option>
                        <option value="ساحل العاج">ساحل العاج</option>
                        <option value="كرواتيا">كرواتيا</option>
                        <option value="كوبا">كوبا</option>
                        <option value="قبرص">قبرص</option>
                        <option value="التشيك">التشيك</option>
                        <option value="جمهورية الكونغو الديمقراطية">
                            جمهورية الكونغو الديمقراطية
                        </option>
                        <option value="الدنمارك">الدنمارك</option>
                        <option value="جيبوتي">جيبوتي</option>
                        <option value="دومينيكا">دومينيكا</option>
                        <option value="جمهورية الدومينيكان">
                            جمهورية الدومينيكان
                        </option>
                        <option value="تيمور الشرقية ">تيمور الشرقية</option>
                        <option value="الإكوادور">الإكوادور</option>
                        <option value="مصر">مصر</option>
                        <option value="السلفادور">السلفادور</option>
                        <option value="غينيا الاستوائية">
                            غينيا الاستوائية
                        </option>
                        <option value="إريتريا">إريتريا</option>
                        <option value="إستونيا">إستونيا</option>
                        <option value="إثيوبيا">إثيوبيا</option>
                        <option value="فيجي">فيجي</option>
                        <option value="فنلندا">فنلندا</option>
                        <option value="فرنسا">فرنسا</option>
                        <option value="الغابون">الغابون</option>
                        <option value="غامبيا">غامبيا</option>
                        <option value="جورجيا">جورجيا</option>
                        <option value="ألمانيا">ألمانيا</option>
                        <option value="غانا">غانا</option>
                        <option value="اليونان">اليونان</option>
                        <option value="جرينادا">جرينادا</option>
                        <option value="غواتيمالا">غواتيمالا</option>
                        <option value="غينيا">غينيا</option>
                        <option value="غينيا بيساو">غينيا بيساو</option>
                        <option value="غويانا">غويانا</option>
                        <option value="هايتي">هايتي</option>
                        <option value="هندوراس">هندوراس</option>
                        <option value="المجر">المجر</option>
                        <option value="آيسلندا">آيسلندا</option>
                        <option value="الهند">الهند</option>
                        <option value="إندونيسيا">إندونيسيا</option>
                        <option value="إيران">إيران</option>
                        <option value="العراق">العراق</option>
                        <option value="جمهورية أيرلندا ">
                            جمهورية أيرلندا
                        </option>
                        <option value="فلسطين">فلسطين</option>
                        <option value="إيطاليا">إيطاليا</option>
                        <option value="جامايكا">جامايكا</option>
                        <option value="اليابان">اليابان</option>
                        <option value="الأردن">الأردن</option>
                        <option value="كازاخستان">كازاخستان</option>
                        <option value="كينيا">كينيا</option>
                        <option value="كيريباتي">كيريباتي</option>
                        <option value="الكويت">الكويت</option>
                        <option value="قرغيزستان">قرغيزستان</option>
                        <option value="لاوس">لاوس</option>
                        <option value="لاوس">لاوس</option>
                        <option value="لاتفيا">لاتفيا</option>
                        <option value="لبنان">لبنان</option>
                        <option value="ليسوتو">ليسوتو</option>
                        <option value="ليبيريا">ليبيريا</option>
                        <option value="ليبيا">ليبيا</option>
                        <option value="ليختنشتاين">ليختنشتاين</option>
                        <option value="ليتوانيا">ليتوانيا</option>
                        <option value="لوكسمبورغ">لوكسمبورغ</option>
                        <option value="مدغشقر">مدغشقر</option>
                        <option value="مالاوي">مالاوي</option>
                        <option value="ماليزيا">ماليزيا</option>
                        <option value="جزر المالديف">جزر المالديف</option>
                        <option value="مالي">مالي</option>
                        <option value="مالطا">مالطا</option>
                        <option value="جزر مارشال">جزر مارشال</option>
                        <option value="موريتانيا">موريتانيا</option>
                        <option value="موريشيوس">موريشيوس</option>
                        <option value="المكسيك">المكسيك</option>
                        <option value="مايكرونيزيا">مايكرونيزيا</option>
                        <option value="مولدوفا">مولدوفا</option>
                        <option value="موناكو">موناكو</option>
                        <option value="منغوليا">منغوليا</option>
                        <option value="الجبل الأسود">الجبل الأسود</option>
                        <option value="المغرب">المغرب</option>
                        <option value="موزمبيق">موزمبيق</option>
                        <option value="بورما">بورما</option>
                        <option value="ناميبيا">ناميبيا</option>
                        <option value="ناورو">ناورو</option>
                        <option value="نيبال">نيبال</option>
                        <option value="هولندا">هولندا</option>
                        <option value="نيوزيلندا">نيوزيلندا</option>
                        <option value="نيكاراجوا">نيكاراجوا</option>
                        <option value="النيجر">النيجر</option>
                        <option value="نيجيريا">نيجيريا</option>
                        <option value="كوريا الشمالية ">كوريا الشمالية</option>
                        <option value="النرويج">النرويج</option>
                        <option value="سلطنة عمان">سلطنة عمان</option>
                        <option value="باكستان">باكستان</option>
                        <option value="بالاو">بالاو</option>
                        <option value="بنما">بنما</option>
                        <option value="بابوا غينيا الجديدة">
                            بابوا غينيا الجديدة
                        </option>
                        <option value="باراغواي">باراغواي</option>
                        <option value="بيرو">بيرو</option>
                        <option value="الفلبين">الفلبين</option>
                        <option value="بولندا">بولندا</option>
                        <option value="البرتغال">البرتغال</option>
                        <option value="قطر">قطر</option>
                        <option value="جمهورية الكونغو">جمهورية الكونغو</option>
                        <option value="جمهورية مقدونيا">جمهورية مقدونيا</option>
                        <option value="رومانيا">رومانيا</option>
                        <option value="روسيا">روسيا</option>
                        <option value="رواندا">رواندا</option>
                        <option value="سانت كيتس ونيفيس">
                            سانت كيتس ونيفيس
                        </option>
                        <option value="سانت لوسيا">سانت لوسيا</option>
                        <option value="سانت فنسينت والجرينادينز">
                            سانت فنسينت والجرينادينز
                        </option>
                        <option value="ساموا">ساموا</option>
                        <option value="سان مارينو">سان مارينو</option>
                        <option value="ساو تومي وبرينسيب">
                            ساو تومي وبرينسيب
                        </option>
                        <option value="السعودية">السعودية</option>
                        <option value="السنغال">السنغال</option>
                        <option value="صربيا">صربيا</option>
                        <option value="سيشيل">سيشيل</option>
                        <option value="سيراليون">سيراليون</option>
                        <option value="سنغافورة">سنغافورة</option>
                        <option value="سلوفاكيا">سلوفاكيا</option>
                        <option value="سلوفينيا">سلوفينيا</option>
                        <option value="جزر سليمان">جزر سليمان</option>
                        <option value="الصومال">الصومال</option>
                        <option value="جنوب أفريقيا">جنوب أفريقيا</option>
                        <option value="كوريا الجنوبية">كوريا الجنوبية</option>
                        <option value="جنوب السودان">جنوب السودان</option>
                        <option value="إسبانيا">إسبانيا</option>
                        <option value="سريلانكا">سريلانكا</option>
                        <option value="السودان">السودان</option>
                        <option value="سورينام">سورينام</option>
                        <option value="سوازيلاند">سوازيلاند</option>
                        <option value="السويد">السويد</option>
                        <option value="سويسرا">سويسرا</option>
                        <option value="سوريا">سوريا</option>
                        <option value="طاجيكستان">طاجيكستان</option>
                        <option value="تنزانيا">تنزانيا</option>
                        <option value="تايلاند">تايلاند</option>
                        <option value="توغو">توغو</option>
                        <option value="تونجا">تونجا</option>
                        <option value="ترينيداد وتوباغو">
                            ترينيداد وتوباغو
                        </option>
                        <option value="تونس">تونس</option>
                        <option value="تركيا">تركيا</option>
                        <option value="تركمانستان">تركمانستان</option>
                        <option value="توفالو">توفالو</option>
                        <option value="أوغندا">أوغندا</option>
                        <option value="أوكرانيا">أوكرانيا</option>
                        <option value="الإمارات العربية المتحدة">
                            الإمارات العربية المتحدة
                        </option>
                        <option value="المملكة المتحدة">المملكة المتحدة</option>
                        <option value="الولايات المتحدة">
                            الولايات المتحدة
                        </option>
                        <option value="أوروغواي">أوروغواي</option>
                        <option value="أوزبكستان">أوزبكستان</option>
                        <option value="فانواتو">فانواتو</option>
                        <option value="فنزويلا">فنزويلا</option>
                        <option value="فيتنام">فيتنام</option>
                        <option value="اليمن">اليمن</option>
                        <option value="زامبيا">زامبيا</option>
                        <option value="زيمبابوي">زيمبابوي</option>
                    </b-form-select>
                </b-form-group>
                <b-form-group label="الصلاحية" label-for="role">
                    <b-form-select id="role" v-model="form.role">
                        <option value="1">ادمن</option>
                        <option value="2">مشرف</option>
                        <option value="3">ناشر</option>
                    </b-form-select>
                </b-form-group>
                <b-button type="submit" variant="primary" class="w-100">
                    اضافة
                </b-button>
            </b-form>
        </b-sidebar>

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

                <span v-else-if="props.column.field === 'role'">
                    <span v-if="props.row.role === '1'">ادمن</span>
                    <span v-else-if="props.row.role === '2'">مشرف</span>
                    <span v-else-if="props.row.role === '3'">ناشر</span>
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
                        <b-dropdown-item :to="`/edit-admin/${props.row.id}`">
                            <feather-icon icon="Edit2Icon" class="mr-50" />
                            <span>تعديل</span>
                        </b-dropdown-item>
                        <b-dropdown-item
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
                        </b-dropdown-item>
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
                    label: "الصلاحية",
                    field: "role",
                    sortable: false,
                },
                {
                    label: "تاريخ التسجيل",
                    field: "register_date",
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
            form: {
                name: "",
                email: "",
                password: "",
                country: "",
                role: "",
            },
        };
    },
    async mounted() {
        try {
            let response = await axios.post(
                "/api/admin/admins",
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
        addAdmin() {
            axios
                .post("/api/admin/add-admin", this.form, {
                    headers: {
                        token: JSON.parse(localStorage.getItem("MatarAdmin"))
                            .token,
                    },
                })
                .then((res) => {
                    alert("تم اضافة المستخدم");
                    location.reload();
                })
                .catch((err) => {
                    alert("المستخدم موجود من قبل");
                });
        },
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
                        "/api/admin/delete-admin",
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
