<template>
    <div>
        <b-tabs content-class="pt-1" fill>
            <b-tab title="الدول">
                <b-card-text>
                    <b-form @submit.prevent="addCountry">
                        <b-form-group label="الدولة" label-for="country">
                            <b-form-input id="country" v-model="country.name" />
                        </b-form-group>
                        <b-form-group label="علم الدولة" label-for="icon">
                            <b-form-file
                                id="icon"
                                accept="image/png"
                                v-model="country.media"
                            />
                        </b-form-group>
                        <b-button type="submit" variant="success"
                            >اضافة</b-button
                        >
                    </b-form>
                    <hr />
                    <br />
                    <h4>الدول المضافة</h4>
                    <br />
                    <b-list-group>
                        <b-list-group-item
                            style="display: flex; align-items: center"
                            v-for="country in countries"
                            :key="country.id"
                        >
                            <b-img
                                :src="`/storage/countries/${country.icon}`"
                                style="max-width: 25px; object-fit: contain"
                            />
                            <span>{{ country.country }}</span>
                            <b-button
                                variant="flat-danger"
                                class="btn-icon rounded-circle"
                                size="sm"
                                style="margin-right: auto; display: block"
                                @click="deleteCountry(country.id)"
                            >
                                <feather-icon icon="XIcon" size="12" />
                            </b-button>
                        </b-list-group-item>
                    </b-list-group>
                </b-card-text>
            </b-tab>
            <b-tab title="صور الاقمار الصناعية">
                <b-card-text>
                    <b-form @submit.prevent="updateSattelite">
                        <b-form-group label="رابط الموقع" label-for="website">
                            <b-form-input
                                id="website"
                                placeholder="رابط الموقع المطلوب عرضه"
                                v-model="sattelite_link"
                            />
                        </b-form-group>
                        <b-button type="submit" variant="success" class="w-100">
                            تعديل
                        </b-button>
                    </b-form>
                </b-card-text>
            </b-tab>
            <b-tab title="نظام التسويق">
                <b-card-text>
                    <b-form @submit.prevent="updateAffiliate">
                        <b-form-group
                            label="نظام التسويق"
                            label-for="affiliate"
                        >
                            <b-form-select
                                id="affiliate"
                                v-model="affiliate_mode"
                            >
                                <option value="1">مُفعل</option>
                                <option value="0">مُعطل</option>
                            </b-form-select>
                        </b-form-group>
                        <b-button type="submit" variant="success" class="w-100">
                            تعديل
                        </b-button>
                    </b-form>
                </b-card-text>
            </b-tab>
        </b-tabs>
    </div>
</template>
<script>
import {
    BFormGroup,
    BFormInput,
    BBadge,
    BFormSelect,
    BTabs,
    BTab,
    BCardText,
    BForm,
    BFormFile,
    BButton,
    BListGroup,
    BListGroupItem,
    BImg,
} from "bootstrap-vue";
import axios from "axios";
export default {
    components: {
        BBadge,
        BFormGroup,
        BFormInput,
        BFormSelect,
        BTabs,
        BTab,
        BCardText,
        BForm,
        BFormFile,
        BButton,
        BListGroup,
        BListGroupItem,
        BImg,
    },
    data() {
        return {
            countries: [],
            sattelite_link: "",
            affiliate_mode: null,
            country: {
                name: "",
                media: "",
            },
        };
    },
    async mounted() {
        try {
            let countries = await axios.get("/api/countries");
            this.countries = countries.data;
        } catch (err) {
            console.log(err);
        }
    },
    methods: {
        addCountry() {
            const data = new FormData();
            data.append("media", this.country.media, this.country.media.name);
            const details = JSON.stringify({
                name: this.country.name,
            });
            data.append("data", details);
            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                    token: JSON.parse(localStorage.getItem("MatarAdmin")).token,
                },
            };
            axios
                .post("/api/admin/add-countries", data, config)
                .then((result) => {
                    alert("تم اضافة الدولة"), location.reload();
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        deleteCountry(id) {
            let confirm = window.confirm("هل انت متأكد من اجراء هذه العملية ؟");
            if (confirm) {
                axios
                    .post(
                        "/api/admin/delete-countries",
                        { id: id },
                        {
                            headers: {
                                token: JSON.parse(
                                    localStorage.getItem("MatarAdmin")
                                ).token,
                            },
                        }
                    )
                    .then((result) => {
                        alert("تم حذف الدولة"), location.reload();
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            }
        },
        updateSattelite() {
            let confirm = window.confirm("هل انت متأكد من اجراء هذه العملية ؟");
            if (confirm) {
                axios
                    .post(
                        "/api/admin/system-settings/satellite",
                        { satellite_link: this.sattelite_link },
                        {
                            headers: {
                                token: JSON.parse(
                                    localStorage.getItem("MatarAdmin")
                                ).token,
                            },
                        }
                    )
                    .then((result) => {
                        alert("تم تعديل صور الاقمار الصناعية");
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            }
        },
        updateAffiliate() {
            let confirm = window.confirm("هل انت متأكد من اجراء هذه العملية ؟");
            if (confirm) {
                axios
                    .post(
                        "/api/admin/system-settings/affiliate",
                        { affiliate_mode: this.affiliate_mode },
                        {
                            headers: {
                                token: JSON.parse(
                                    localStorage.getItem("MatarAdmin")
                                ).token,
                            },
                        }
                    )
                    .then((result) => {
                        alert("تم تعديل وضع نظام التسويق"), location.reload();
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            }
        },
    },
};
</script>
