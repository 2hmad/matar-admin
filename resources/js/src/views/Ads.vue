<template>
    <div>
        <b-form @submit.prevent="addAd">
            <b-form-group label="عنوان الاعلان" label-for="v-title">
                <b-form-input
                    id="v-title"
                    placeholder="عنوان الاعلان"
                    required
                    v-model="form.title"
                />
            </b-form-group>
            <b-form-group label="رابط التوجيه" label-for="v-url">
                <b-form-input
                    id="v-url"
                    type="url"
                    placeholder="رابط التوجيه"
                    v-model="form.redirect"
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
            <b-form-group label="مكان الاعلان" label-for="v-location">
                <b-form-select id="v-location" v-model="form.location">
                    <option value="1">قسم التوقعات</option>
                    <option value="2">قسم وسائط الطقس</option>
                    <option value="0">كلاهما</option>
                </b-form-select>
            </b-form-group>
            <b-form-group label="الدولة" label-for="v-country">
                <b-form-select id="v-country" v-model="form.country">
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
            <b-form-group label="صورة / فيديو" label-for="v-pic">
                <b-form-file
                    placeholder="اختر صورة / فيديو او اسحبه الي هنا"
                    drop-placeholder="افلت الملف هنا..."
                    id="pic"
                    accept="image/jpeg, image/png, image/jpg, video/mp4, video/flv, video/3gp, video/mov, video/avi, video/wmv"
                    required
                    v-model="form.media"
                />
            </b-form-group>
            <b-button type="submit" variant="primary" class="w-100">
                اضافة
            </b-button>
        </b-form>
        <br /><br /><br />
        <h4 v-if="ads.length > 0">الاعلانات المنشورة</h4>
        <br />
        <b-row>
            <b-col md="5" lg="3" v-for="ad in ads" :key="ad.id">
                <div class="card">
                    <img
                        :src="`/storage/ads/${ad.media}`"
                        class="card-img-top"
                        style="height: 130px; object-fit: contain"
                    />
                    <div class="card-body">
                        <b-card-title>{{ ad.title }}</b-card-title>
                        <b-button
                            variant="primary"
                            class="w-100"
                            v-b-modal="`modal-ad-${ad.id}`"
                        >
                            تفاصيل
                        </b-button>
                        <b-modal
                            :id="`modal-ad-${ad.id}`"
                            scrollable
                            title="تفاصيل الاعلان"
                            hide-footer
                        >
                            <b-card-text>
                                <div style="line-height: 2.9rem">
                                    <div>
                                        <span style="font-weight: bold">
                                            تاريخ الاختفاء :
                                        </span>
                                        <span>{{ ad.hide }}</span>
                                    </div>
                                    <div>
                                        <span style="font-weight: bold">
                                            مكان النشر :
                                        </span>
                                        <span v-if="ad.location == '1'">
                                            قسم التوقعات
                                        </span>
                                        <span v-if="ad.location == '2'">
                                            قسم وسائط الطقس
                                        </span>
                                        <span v-if="ad.location == '0'">
                                            كلا القسمين
                                        </span>
                                    </div>
                                    <div>
                                        <span style="font-weight: bold">
                                            الدولة :
                                        </span>
                                        <span>{{ ad.country }}</span>
                                    </div>
                                    <div>
                                        <span style="font-weight: bold">
                                            رابط التحويل :
                                        </span>
                                        <span>{{ ad.redirect }}</span>
                                    </div>
                                </div>
                                <div style="line-height: 2.9rem">
                                    <div style="text-align: center">
                                        <span style="font-weight: bold">
                                            اجمالي عدد المشاهدات :
                                        </span>
                                        <span>{{
                                            ad.details.filter(
                                                (item) => item.type == "view"
                                            ).length
                                        }}</span>
                                    </div>
                                </div>
                                <table class="w-100" style="text-align: center">
                                    <thead style="background: #f3f2f7">
                                        <tr>
                                            <th style="color: #5e5873">
                                                الدولة
                                            </th>
                                            <th style="color: #5e5873">
                                                مشاهدات
                                            </th>
                                        </tr>
                                    </thead>
                                    <tr
                                        v-for="detail in ad.details.filter(
                                            (item) => item.type == 'view'
                                        )"
                                        :key="detail.id"
                                    >
                                        <th>
                                            <span class="font-weight-bold">
                                                {{ detail.country }}
                                            </span>
                                        </th>
                                        <td>{{ detail.count }}</td>
                                    </tr>
                                </table>
                                <br />
                                <div style="line-height: 2.9rem">
                                    <div style="text-align: center">
                                        <span style="font-weight: bold">
                                            اجمالي عدد النقرات :
                                        </span>
                                        <span>{{
                                            ad.details.filter(
                                                (item) => item.type == "click"
                                            ).length
                                        }}</span>
                                    </div>
                                </div>
                                <table class="w-100" style="text-align: center">
                                    <thead style="background: #f3f2f7">
                                        <tr>
                                            <th style="color: #5e5873">
                                                الدولة
                                            </th>
                                            <th style="color: #5e5873">
                                                النقرات
                                            </th>
                                        </tr>
                                    </thead>
                                    <tr
                                        v-for="detail in ad.details.filter(
                                            (item) => item.type == 'click'
                                        )"
                                        :key="detail.id"
                                    >
                                        <th>
                                            <span class="font-weight-bold">
                                                {{ detail.country }}
                                            </span>
                                        </th>
                                        <td>{{ detail.count }}</td>
                                    </tr>
                                </table>
                            </b-card-text>
                        </b-modal>
                        <br /><br />
                        <b-button
                            variant="danger"
                            class="w-100"
                            @click="deleteAd(ad.id)"
                        >
                            حذف
                        </b-button>
                    </div>
                </div>
            </b-col>
        </b-row>
    </div>
</template>

<script>
import {
    BButton,
    BFormGroup,
    BFormInput,
    BFormFile,
    BRow,
    BCol,
    BCard,
    BCardImg,
    BCardTitle,
    BCardText,
    BFormSelect,
    BForm,
    BTable,
} from "bootstrap-vue";
import flatPickr from "vue-flatpickr-component";
import axios from "axios";
export default {
    components: {
        BButton,
        BFormGroup,
        BFormInput,
        BFormFile,
        BRow,
        BCol,
        BCard,
        BCardImg,
        BCardTitle,
        BCardText,
        flatPickr,
        BFormSelect,
        BForm,
        BTable,
    },
    data() {
        return {
            countries: [],
            ads: [],
            form: {
                title: "",
                redirect: "",
                hide: "",
                location: "",
                country: "",
                media: null,
            },
        };
    },
    async mounted() {
        try {
            let response = await axios.get("/api/countries");
            this.countries = response.data;
            let ads = await axios.get("/api/ads");
            this.ads = ads.data;
        } catch (err) {
            console.log(err);
        }
    },
    methods: {
        addAd() {
            const data = new FormData();
            data.append("media", this.form.media, this.form.media.name);
            const details = JSON.stringify({
                title: this.form.title,
                redirect: this.form.redirect,
                hide: this.form.hide,
                location: this.form.location,
                country: this.form.country,
            });
            data.append("data", details);
            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                    token: JSON.parse(localStorage.getItem("MatarAdmin")).token,
                },
            };
            axios
                .post("/api/admin/add-ad", data, config)
                .then((result) => {
                    alert("تم اضافة الاعلان"), location.reload();
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        deleteAd(id) {
            var confirm = window.confirm("هل انت متأكد من الحذف");
            if (confirm) {
                axios
                    .post(
                        "/api/admin/delete-ad",
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
                        alert("تم حذف الاعلان"), location.reload();
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            }
        },
    },
};
</script>
<style lang="scss">
@import "@core/scss/vue/libs/vue-flatpicker.scss";
</style>
