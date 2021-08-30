import apiClient from "@/axios";

export default {
    subscribe(email) {
        return apiClient.post("/data/newsletter", {
            email,
        });
    },
};
