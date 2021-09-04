import apiClient from "@/axios";

export default {
    fetch(page) {
        return apiClient.get("/blog/posts", ["page." + page]);
    },
};
