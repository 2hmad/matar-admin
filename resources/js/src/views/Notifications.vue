<template>
    <div>
        <b-button
            variant="outline-primary"
            class="btn-icon"
            style="margin-right: auto; display: block"
            v-b-modal.modal-center
        >
            <feather-icon icon="PlusIcon" class="mr-50" />
            <span class="align-middle">ارسال اشعار</span>
        </b-button>
        <b-modal id="modal-center" scrollable title="ارسال اشعار" hide-footer>
            <b-card-text>
                <b-form @submit.prevent="addNotification">
                    <b-form-group label="عنوان الاشعار" label-for="v-title">
                        <b-form-input
                            id="v-title"
                            placeholder="عنوان الاشعار"
                            v-model="form.subject"
                        />
                    </b-form-group>
                    <b-form-group label="نص الاشعار" label-for="v-desc">
                        <b-form-textarea
                            id="v-desc"
                            placeholder="نص الاشعار"
                            v-model="form.content"
                        />
                    </b-form-group>
                    <b-form-group label="التاريخ والوقت" label-for="v-date">
                        <flat-pickr
                            class="form-control"
                            id="v-date"
                            :config="{
                                enableTime: true,
                                dateFormat: 'Y-m-d H:i:s',
                            }"
                            v-model="form.date"
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
                    <b-form-group label="الظهور لـ" label-for="v-visiblity">
                        <b-form-select
                            id="v-visiblity"
                            v-model="form.appear_for"
                        >
                            <option value="public">العامة</option>
                            <option value="accounts">الحسابات</option>
                            <option value="duo">الاثنين معاً</option>
                        </b-form-select>
                    </b-form-group>
                    <b-form-group label="الظهور في" label-for="v-type">
                        <b-form-select id="v-type" v-model="form.appear_as">
                            <option value="page">صفحة الاشعارات</option>
                            <!-- <option>رسالة منبثقة</option> -->
                        </b-form-select>
                    </b-form-group>
                    <b-form-group label="رابط التوجيه" label-for="v-url">
                        <b-form-input
                            id="v-url"
                            type="url"
                            placeholder="رابط التوجيه"
                            v-model="form.redirect"
                        />
                    </b-form-group>
                    <b-form-group
                        label="جدولة الاشعار"
                        label-for="v-publishDate"
                    >
                        <flat-pickr
                            class="form-control"
                            id="v-publishDate"
                            :config="{
                                enableTime: true,
                                dateFormat: 'Y-m-d H:i:s',
                            }"
                            v-model="form.schedule"
                        />
                    </b-form-group>
                    <b-form-group label="صورة" label-for="v-pic">
                        <b-form-file
                            placeholder="اختر صورة او اسحبه الي هنا"
                            drop-placeholder="افلت الملف هنا..."
                            id="pic"
                            accept="image/jpeg, image/png, image/jpg"
                            v-model="form.media"
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

                <span v-else-if="props.column.field === 'media'">
                    <a
                        :href="`/storage/notifications/${props.row.media}`"
                        target="_blank"
                    >
                        <img
                            :src="`/storage/notifications/${props.row.media}`"
                            style="max-width: 80px"
                        />
                    </a>
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
                            <b-dropdown-item
                                @click="deleteNotify(props.row.id)"
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
    BFormTextarea,
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
        flatPickr,
        BFormTextarea,
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
                    label: "الصورة المرفقة",
                    field: "media",
                    sortable: false,
                },
                {
                    label: "العنوان",
                    field: "subject",
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
            countries: [],
            form: {
                subject: "",
                content: "",
                date: "",
                country: null,
                appear_for: "",
                appear_as: "",
                redirect: "",
                schedule: "",
                media: null,
            },
        };
    },
    async mounted() {
        try {
            let response = await axios.get("/api/countries");
            this.countries = response.data;
        } catch (err) {
            alert("حدث خطأ ما");
        }
        try {
            let response = await axios.get("/api/all-notifications");
            this.rows = response.data;
        } catch (err) {
            alert("حدث خطأ ما");
        }
    },
    methods: {
        addNotification() {
            const data = new FormData();
            data.append("media", this.form.media, this.form.media.name);
            const details = JSON.stringify({
                subject: this.form.subject,
                content: this.form.content,
                date: this.form.date,
                country: this.form.country,
                appear_for: this.form.appear_for,
                appear_as: this.form.appear_as,
                redirect: this.form.redirect,
                schedule: this.form.schedule,
            });
            data.append("data", details);
            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                    token: JSON.parse(localStorage.getItem("MatarAdmin")).token,
                },
            };
            axios
                .post("/api/admin/notifications", data, config)
                .then((result) => {
                    alert("تم ارسال الاشعار"), location.reload();
                })
                .catch((err) => {
                    alert("حدث خطأ ما");
                });
        },
        deleteNotify(id) {
            let answer = window.confirm("هل متأكد من الحذف ؟");
            if (answer) {
                axios
                    .post(
                        "/api/admin/delete-notification",
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
                    .then((result) => {
                        alert("تم حذف الاشعار"), location.reload();
                    })
                    .catch((err) => {
                        alert("حدث خطأ ما");
                    });
            }
        },
    },
};
</script>

<style lang="scss">
@import "@core/scss/vue/libs/vue-flatpicker.scss";
</style>
