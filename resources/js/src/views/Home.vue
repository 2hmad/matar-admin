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
                                {{ users }}
                            </h2>
                            <span>عدد المستخدمين</span>
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
                                {{ subsCount }}
                            </h2>
                            <span>عدد المشتركين</span>
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
                                {{ postsCount }}
                            </h2>
                            <span>عدد المنشورات</span>
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
        <div class="row">
            <div class="col-lg">
                <div class="card">
                    <div
                        class="card-body d-flex justify-content-between align-items-center"
                    >
                        <div class="truncate">
                            <h2 class="mb-25 font-weight-bolder">
                                {{ weatherShotsCount }}
                            </h2>
                            <span>عدد الوسائط المنشورة</span>
                        </div>
                        <span
                            class="b-avatar badge-light-primary rounded-circle"
                            style="width: 45px; height: 45px"
                        >
                            <span class="b-avatar-custom">
                                <feather-icon icon="BookmarkIcon" size="22" />
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
                            <h2 class="mb-25 font-weight-bolder">0</h2>
                            <span>المتواجدون حالياً</span>
                        </div>
                        <span
                            class="b-avatar badge-light-success rounded-circle"
                            style="width: 45px; height: 45px"
                        >
                            <span class="b-avatar-custom">
                                <feather-icon icon="CircleIcon" size="22" />
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                <h4>الصفحات الاكثر زيارة</h4>
                <vue-good-table
                    :columns="pagesVisitColumns"
                    :rows="pagesVisitRows"
                >
                    <div slot="emptystate">لا توجد بيانات</div>
                    <template slot="table-row" slot-scope="props">
                        <span
                            v-if="props.column.field === 'fullName'"
                            class="text-nowrap"
                        >
                            <span class="text-nowrap">{{
                                props.row.fullName
                            }}</span>
                        </span>
                        <!-- Column: Common -->
                        <span v-else>
                            {{ props.formattedRow[props.column.field] }}
                        </span>
                    </template>
                </vue-good-table>
            </div>
            <div class="col-lg">
                <h4>عدد الزوار</h4>
                <vue-good-table
                    :columns="visitCountColumns"
                    :rows="visitCountRows"
                >
                    <div slot="emptystate">لا توجد بيانات</div>
                    <template slot="table-row" slot-scope="props">
                        <span
                            v-if="props.column.field === 'fullName'"
                            class="text-nowrap"
                        >
                            <span class="text-nowrap">{{
                                props.row.fullName
                            }}</span>
                        </span>
                        <!-- Column: Common -->
                        <span v-else>
                            {{ props.formattedRow[props.column.field] }}
                        </span>
                    </template>
                </vue-good-table>
            </div>
        </div>
        <br /><br />
        <h4>اكثر المنشورات اعجاباً</h4>
        <vue-good-table
            :columns="columns"
            :rows="rows"
            :rtl="dir"
            :search-options="{
                enabled: true,
                externalQuery: searchTerm,
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
import axios from "axios";
import { VueGoodTable } from "vue-good-table";
export default {
    components: {
        VueGoodTable,
    },
    data() {
        return {
            pageLength: 3,
            dir: false,
            columns: [
                {
                    label: "#",
                    field: "id",
                    hidden: true,
                },
                {
                    label: "العنوان",
                    field: "title",
                    sortable: false,
                },
                {
                    label: "الدولة",
                    field: "country",
                    sortable: false,
                },
                {
                    label: "التاريخ والوقت",
                    field: "date",
                },
                {
                    label: "عدد الاعجابات",
                    field: "likes",
                },
                {
                    label: "الاعدادات",
                    field: "action",
                    sortable: false,
                },
            ],
            rows: [],
            pagesVisitColumns: [
                {
                    label: "الصفحة",
                    field: "title",
                    sortable: false,
                },
                {
                    label: "عدد الزيارات",
                    field: "country",
                    sortable: false,
                },
            ],
            pagesVisitRows: [],
            visitCountColumns: [
                {
                    label: "الدولة",
                    field: "title",
                    sortable: false,
                },
                {
                    label: "عدد الزوار",
                    field: "country",
                    sortable: false,
                },
            ],
            visitCountRows: [],

            searchTerm: "",
            users: null,
            subsCount: null,
            postsCount: null,
            weatherShotsCount: null,
        };
    },
    async mounted() {
        try {
            let users = await axios.get("/api/usersCount");
            this.users = users.data;
            let subsCount = await axios.get("/api/subsCount");
            this.subsCount = subsCount.data;
            let postsCount = await axios.get("/api/postsCount");
            this.postsCount = postsCount.data;
            let weatherShotsCount = await axios.get("/api/weatherShotsCount");
            this.weatherShotsCount = weatherShotsCount.data;
            let likedPosts = await axios.get("/api/most-likes-posts");
            this.rows = likedPosts.data;
        } catch (err) {
            alert("حدث خطأ ما");
        }
    },
};
</script>

<style></style>
