<template>
    <div>
        <b-form @submit.prevent="addOutlook">
            <b-row>
                <b-col cols="12">
                    <b-form-group label="العنوان" label-for="v-title">
                        <b-form-input
                            id="v-title"
                            placeholder="العنوان"
                            v-model="form.title"
                        />
                    </b-form-group>
                </b-col>

                <b-col cols="12">
                    <b-form-group label="التاريخ" label-for="v-date">
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
                </b-col>

                <b-col cols="12">
                    <b-form-group label="الدولة" label-for="v-country">
                        <b-form-select id="v-country" v-model="form.country">
                            <option
                                v-for="country in countries"
                                :key="country.id"
                            >
                                {{ country.country }}
                            </option>
                        </b-form-select>
                    </b-form-group>
                </b-col>

                <b-col cols="12">
                    <b-form-group label="التفاصيل" label-for="v-details">
                        <b-form-textarea
                            id="v-details"
                            rows="6"
                            v-model="form.details"
                        />
                    </b-form-group>
                </b-col>

                <b-col cols="12">
                    <b-form-group label="صور / فيديو للحالة">
                        <b-form-file
                            placeholder="اختر الصور والفيديوهات او اسحبها الي هنا"
                            drop-placeholder="افلت الملفات هنا..."
                            accept="image/jpeg, image/png, image/jpg, video/mp4, video/flv, video/3gp, video/mov, video/avi, video/wmv"
                            multiple
                            @change="onFileChange"
                        />
                    </b-form-group>
                </b-col>

                <b-col cols="12">
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
                </b-col>

                <b-col cols="12">
                    <b-form-group label="تاريخ الاختفاء" label-for="v-hideDate">
                        <flat-pickr
                            class="form-control"
                            id="v-hideDate"
                            :config="{
                                enableTime: true,
                                dateFormat: 'Y-m-d H:i:s',
                            }"
                            v-model="form.hideDate"
                        />
                    </b-form-group>
                </b-col>

                <b-col cols="12">
                    <b-button type="submit" variant="primary" class="mr-1">
                        اضافة
                    </b-button>
                </b-col>
            </b-row>
        </b-form>
    </div>
</template>
<script>
import {
    BRow,
    BCol,
    BFormGroup,
    BFormInput,
    BFormCheckbox,
    BForm,
    BButton,
    BFormSelect,
    BFormTextarea,
    BFormFile,
} from "bootstrap-vue";
import flatPickr from "vue-flatpickr-component";
import axios from "axios";
export default {
    components: {
        BRow,
        BCol,
        BFormGroup,
        BFormInput,
        BFormCheckbox,
        BForm,
        BButton,
        BFormSelect,
        BFormTextarea,
        flatPickr,
        BFormFile,
    },
    data() {
        return {
            dateNtim: null,
            countries: [],
            form: {
                title: "",
                date: "",
                country: "",
                details: "",
                attachments: [],
                schedule: "",
                hideDate: "",
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
    },
    methods: {
        onFileChange(event) {
            let selectedFiles = event.target.files;
            for (let i = 0; i < selectedFiles.length; i++) {
                this.form.attachments.push(selectedFiles[i]);
            }
        },
        addOutlook() {
            const data = new FormData();
            for (let i = 0; i < this.form.attachments.length; i++) {
                data.append("files[]", this.form.attachments[i]);
            }
            const details = JSON.stringify({
                title: this.form.title,
                date: this.form.date,
                country: this.form.country,
                details: this.form.details,
                schedule: this.form.schedule,
                hideDate: this.form.hideDate,
            });
            data.append("data", details);
            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                    token: JSON.parse(localStorage.getItem("MatarAdmin")).token,
                },
            };
            axios
                .post("/api/admin/add-outlook", data, config)
                .then((result) => {
                    alert("تم اضافة التوقع"), (location.href = "/outlooks");
                })
                .catch((err) => {
                    alert("حدث خطأ ما");
                });
        },
    },
};
</script>
<style lang="scss">
@import "@core/scss/vue/libs/vue-flatpicker.scss";
</style>
