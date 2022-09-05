<template>
    <div>
        <header-component></header-component>
        <router-view></router-view>
        <footer-component></footer-component>
    </div>
</template>

<script>
import FooterComponent from "../pages/components/FooterComponent.vue";
import HeaderComponent from "../pages/components/HeaderComponent.vue";
export default {
    name: "App",
    components: { FooterComponent, HeaderComponent },
};
</script>
