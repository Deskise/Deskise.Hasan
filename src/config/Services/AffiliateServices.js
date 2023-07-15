import apiClient from "@/config/axios";

export default {
    save(data) {
        console.log('from sevices', data);
        return apiClient.post("/affiliate/save", data, true);
    },
    getAffiliats() {
        return apiClient.get("/affiliate", [], true)
    },
    toggle() {
        console.log('you are here');
        return apiClient.post("/affiliate/toggle-affiliate-links", [], true)
    }
}