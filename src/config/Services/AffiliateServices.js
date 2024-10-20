import apiClient from "@/config/axios";

export default {
    save(data) {
        return apiClient.post("/affiliate/save", data, true);
    },
    getAffiliats() {
        return apiClient.get("/affiliate", [], true)
    },
    toggle() {
        return apiClient.post("/affiliate/toggle-affiliate-links", [], true)
    }
}