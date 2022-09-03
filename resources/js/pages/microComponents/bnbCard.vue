<template>
    <div class="apartment-card">
        <div class="img-container">
            <a :href="`/bnb-view/data/${apartment.id}`">
            <img class="apartment_img" :src="`/storage/${apartment.image}`" :alt="apartment.name">
            </a>
        </div>
        <h5 class="apartment_name">{{apartment.name}}</h5>
        <p class="apartment_address">{{apartment.full_address}}</p>
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
    margin: .75rem;
    transition: 0.1s;
    &:hover {
        scale: 102%;
    }
    
    .img-container {
        width: 300px;
        height: 300px;
        border-radius: 20px;
        background-color: $bg-primary-light;
        border: 1px solid $primary-green;
        overflow: hidden;

        img {
            max-width: 100%;
            height: 100%;
            object-fit: cover;
        }
    }

    .apartment_name {
        color: $text-gray-light;
        font-size: 1.5rem;
        margin: .5rem 0 0;
    }
    .apartment_address {
        color: $text-gray-dark;
        font-size: 1rem;
    }
}
</style>