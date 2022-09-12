<template>
    <div class="apartment-card">
        <div
            class="img-container"
            :class="{ sponsored: apartment.expiration_date }"
        >
            <div v-if="apartment.expiration_date">
                <font-awesome-icon icon="fa-solid fa-star " />
                <font-awesome-icon icon="fa-solid fa-star " id="up" />
            </div>

            <a :href="`/bnb-view/data/${apartment.id}`">
                <img
                    height="250"
                    class="apartment_img"
                    :src="`/storage/${apartment.image}`"
                    :alt="apartment.name"
                />
            </a>
        </div>
        <a :href="`/bnb-view/data/${apartment.id}`">
            <h5 class="apartment_name">
                {{ apartment.name }}
            </h5>
        </a>
        <p class="apartment_address">{{ apartment.full_address }}</p>
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
@import "../../../sass/variables";

.apartment-card {
    min-height: 200px;
    a {
        text-decoration: none;
    }
    text-align: center;
    transition: 0.1s;
    &:hover {
        scale: 102%;
    }

    .img-container {
        position: relative;
        width: 100%;
        height: 100%;
        border-radius: 20px;
        background-color: $bg-primary-light;
        border: 2px solid $primary-green;
        overflow: hidden;
        box-shadow: 3px 3px 3px -2px rgba(103, 186, 113, 0.67);
        -webkit-box-shadow: 3px 3px 3px -2px rgba(103, 186, 113, 0.67);
        -moz-box-shadow: 3px 3px 3px -2px rgba(103, 186, 113, 0.67);
        .fa-star {
            font-size: 1.5rem;
            color: rgba(0, 0, 0, 0.445);
            position: absolute;
            top: 15px;
            right: 15px;
            scale: 1.3;
        }
        #up {
            color: rgb(211, 166, 19);
            scale: 1.1;
        }
        img {
            width: 100%;
            object-fit: cover;
            object-position: center;
        }
    }

    .apartment_name {
        color: $text-gray-light;
        font-size: 1.25rem;
        margin: 0.5rem 0 0;
    }
    .apartment_address {
        color: $text-gray-dark;
        font-size: 1rem;
    }
    .img-container.sponsored {
        border: 2px solid #bf953f;
        box-shadow: 3px 3px 3px -2px rgba(255, 239, 89, 0.67);
        -webkit-box-shadow: 3px 3px 3px -2px rgba(255, 239, 89, 0.67);
        -moz-box-shadow: 3px 3px 3px -2px rgba(255, 239, 89, 0.67);
    }
}
</style>
