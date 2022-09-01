<template>
    <main>
        <HeaderComponent/>
        <div>
            <div v-for="apartment in apartments" :key="apartment.id">
                <img class="apartment_img" :src="`/storage/${apartment.image}`" :alt="apartment.name">
            </div>
	    </div>
    </main>
</template>

<script>

import HeaderComponent from './components/HeaderComponent.vue';

export default {
    name: "BnbView",
    components: { HeaderComponent },
    data() {
		return {
			Id: this.$route.params.id,
            apartments: [],
		}
	},

    created() {
        axios.get('http://localhost:8000/api/apartment', {
            params: {
                Id: this.Id,
            }
        })
            .then((response) => {
                this.apartments = response.data;
            });
    }
}
</script>

<style lang="scss" scoped>

</style>