<template>
    <p class="clearfix mb-0">
        <span class="float-md-left d-block d-md-inline-block mt-25">
            <span class="d-none d-sm-inline-block">جميع الحقوق محفوظة</span>
            © {{ new Date().getFullYear() }}
            <b-link class="ml-25" href="https://digitwires.com" target="_blank">
                شركة ديجيت وايرز
            </b-link>
        </span>
    </p>
</template>

<script>
import { BLink } from "bootstrap-vue";

export default {
    components: {
        BLink,
    },
};
</script>
