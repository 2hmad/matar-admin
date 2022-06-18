<template>
    <div>
        <b-row>
            <b-col>
                <router-link to="/pending-shots">
                    <b-button
                        variant="outline-primary"
                        class="btn-icon"
                        style="margin-right: auto; display: block"
                    >
                        <feather-icon icon="VideoIcon" class="mr-50" />
                        <span class="align-middle">مراجعه الطلبات المرسلة</span>
                    </b-button>
                </router-link>
            </b-col>
            <b-button
                variant="outline-primary"
                class="btn-icon"
                style="margin-right: auto; display: block"
                v-b-modal.modal-center
            >
                <feather-icon icon="PlusIcon" class="mr-50" />
                <span class="align-middle">اضافة</span>
            </b-button>
        </b-row>
        <b-modal
            id="modal-center"
            centered
            title="اضافة صورة او مقطع"
            hide-footer
        >
            <b-card-text>
                <b-form @submit.prevent="addShot">
                    <b-form-group label="اسم المصور" label-for="v-photographer">
                        <b-form-input
                            id="v-photographer"
                            placeholder="اسم المصور"
                            v-model="form.photographer"
                        />
                    </b-form-group>
                    <b-form-group label="الموقع" label-for="v-location">
                        <b-form-input
                            id="v-location"
                            placeholder="الموقع"
                            v-model="form.location"
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
                    <b-form-group
                        label="جدولة المنشور"
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
                    <b-form-group label="تاريخ الاختفاء" label-for="v-hideDate">
                        <flat-pickr
                            class="form-control"
                            id="v-hideDate"
                            :config="{
                                enableTime: true,
                                dateFormat: 'Y-m-d H:i:s',
                            }"
                            v-model="form.hide"
                        />
                    </b-form-group>
                    <b-form-group label="صورة / فيديو" label-for="v-pic">
                        <b-form-file
                            placeholder="اختر فيديو او اسحبه الي هنا"
                            drop-placeholder="افلت الملف هنا..."
                            id="pic"
                            accept="image/jpeg, image/png, image/jpg, video/mp4, video/flv, video/3gp, video/mov, video/avi, video/wmv"
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
                            <b-dropdown-item :to="`/edit-shot/${props.row.id}`">
                                <feather-icon icon="Edit2Icon" class="mr-50" />
                                <span>تعديل</span>
                            </b-dropdown-item>
                            <b-dropdown-item @click="deleteShot(props.row.id)">
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
    BModal,
    BFormFile,
    BCol,
    BRow,
    BForm,
    BCardText,
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
        BModal,
        flatPickr,
        BFormFile,
        BCol,
        BRow,
        BForm,
        BCardText,
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
                    label: "التاريخ والوقت",
                    field: "date",
                    sortable: false,
                },
                {
                    label: "تاريخ الاختفاء",
                    field: "hide",
                    sortable: false,
                },
                {
                    label: "عدد المشاركات",
                    field: "shares",
                },
                {
                    label: "الاعدادات",
                    field: "action",
                    sortable: false,
                },
            ],
            rows: [],
            searchTerm: "",
            editForm: {
                photographer: "",
                location: "",
                date: "",
                schedule: "",
                hide: "",
            },
            form: {
                photographer: "",
                location: "",
                date: "",
                schedule: "",
                hide: "",
                media: null,
            },
        };
    },
    async mounted() {
        try {
            let response = await axios.get("/api/weatherShots");
            this.rows = response.data;
        } catch (err) {
            alert("حدث خطأ ما");
        }
    },
    methods: {
        editShot(e) {
            console.log();
        },
        deleteShot(id) {
            var answer = window.confirm("هل انت متأكد من الحذف");
            if (answer) {
                axios
                    .post(
                        "/api/admin/delete-weathershot",
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
                        alert("تم حذف الصورة / مقطع الفيديو للطقس"),
                            location.reload();
                    })
                    .catch((err) => {
                        alert("حدث خطأ ما");
                    });
            }
        },
        addShot() {
            const data = new FormData();
            data.append("media", this.form.media, this.form.media.name);
            const details = JSON.stringify({
                photographer: this.form.photographer,
                location: this.form.location,
                date: this.form.date,
                schedule: this.form.schedule,
                hide: this.form.hide,
            });
            data.append("data", details);
            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                    token: JSON.parse(localStorage.getItem("MatarAdmin")).token,
                },
            };
            axios
                .post("/api/admin/add-weathershot", data, config)
                .then((result) => {
                    alert("تم اضافة صورة / مقطع الطقس"), location.reload();
                })
                .catch((err) => {
                    alert("حدث خطأ ما");
                });
        },
        share(id) {
            var copyText = "https://rain-app.com/shot/" + id;
            navigator.clipboard.writeText(copyText);
            alert("تم نسخ رابط المشاركة");
        },
        deleteExpired() {
            var answer = window.confirm("هل انت متأكد من العملية ؟");
            if (answer) {
                axios
                    .post(
                        "/api/admin/delete-unused-shots",
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
                        alert("تم حذف صور / مقاطع الفيديو المنتهية"),
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
<style lang="scss">
@import "@core/scss/vue/libs/vue-flatpicker.scss";
</style>
