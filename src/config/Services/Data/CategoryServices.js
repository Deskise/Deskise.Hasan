import apiClient from "@/config/axios";

export default {
  fetch(id = 0) {
    return apiClient.get("/data/categories" + (id !== 0 ? "/" + id : ""));
  },
  subcategories(id = 0) {
    return apiClient.get(`/data/categories/${id}/subcategories`);
  },
};
