<template>
    <div class="apartment-card">
        <a :href="`/bnb-view/data/${apartment.id}`">
        <img class="apartment_img" :src="`/storage/${apartment.image}`" :alt="apartment.name">
        </a>
    </div>
</template>

<script>
export default {

    name: "bnbCard",

    props: {
        apartment: Object,
    },
};

</script>

<style lang="scss" scoped>
@import '../../../sass/variables';

    .apartment-card {
        width: 250px;
        height: 250px;
        border-radius: 20px;
        background-color: lightgray;
        border: 4px solid $primary-green;
        overflow: hidden;
        margin-left: 20px;
        margin-bottom: 20px;

        img {
            width: 100%;
            height: 100%;
        }
    }
</style>