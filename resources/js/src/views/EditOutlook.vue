<template>
    <div>
        <b-form @submit.prevent="editOutlook">
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
                            <b-form-select-option
                                :value="form.country"
                                hidden
                                selected
                            >
                                {{ form.country }}
                            </b-form-select-option>
                            <b-form-select-option
                                v-for="country in countries"
                                :key="country.id"
                            >
                                {{ country.country }}
                            </b-form-select-option>
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
                        تعديل
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
    BFormSelectOption,
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
        BFormSelectOption,
    },
    data() {
        return {
            countries: [],
            form: {
                title: "",
                date: "",
                country: "",
                details: "",
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
            console.log(err);
        }
        try {
            let response = await axios.get(
                `/api/outlook/${this.$route.params.id}`
            );
            this.form.title = response.data.title;
            this.form.date = response.data.date;
            this.form.country = response.data.country;
            this.form.details = response.data.details;
            this.form.schedule = response.data.schedule;
            this.form.hideDate = response.data.hide;
        } catch (err) {
            console.log(err);
        }
    },
    methods: {
        editOutlook() {
            const config = {
                headers: {
                    token: JSON.parse(localStorage.getItem("MatarAdmin")).token,
                },
            };
            axios
                .post(
                    "/api/admin/edit-outlook",
                    {
                        id: this.$route.params.id,
                        title: this.form.title,
                        date: this.form.date,
                        country: this.form.country,
                        details: this.form.details,
                        schedule: this.form.schedule,
                        hideDate: this.form.hideDate,
                    },
                    config
                )
                .then((result) => {
                    alert("تم تعديل التوقع"), (location.href = "/outlooks");
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
};
</script>
<style lang="scss">
@import "@core/scss/vue/libs/vue-flatpicker.scss";
</style>
