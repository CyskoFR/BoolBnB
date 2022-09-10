import Vue from "vue";
export default Vue.observable({
    full_address: "",
    beds: 1,
    rooms: 1,
    distance: 20,
    category_id: null,
    category_name: "",
    selectedServices: [],
    selectedServicesNames: [],
    //tutti, chiamata gener
    services: [],
    apartments: [],
    //sentinella
    last_page: 0,
});
