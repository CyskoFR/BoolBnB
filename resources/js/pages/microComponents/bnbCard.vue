<template>
    <div class="apartment-card">
        <div class="img-container">
            <a :href="`/bnb-view/data/${apartment.id}`">
            <img class="apartment_img" :src="`/storage/${apartment.image}`" :alt="apartment.name">
            </a>
        </div>
        <h5>{{apartment.name}}</h5>
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

    margin-bottom: 15px;
    
    .img-container {
        width: 300px;
        height: 300px;
        border-radius: 20px;
        background-color: lightgray;
        border: 1px solid $primary-green;
        overflow: hidden;
        margin-left: 10px;
        margin-right: 10px;

        img {
            width: 100%;
            height: 100%;
        }
    }

    h5 {
        color: $text-gray-light;
        font-size: 17px;
        margin-left: 15px;
        margin-top: 10px;
    }
}
    
</style>