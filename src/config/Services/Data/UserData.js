import apiClient from "@/config/axios";

export default {
  data(id) {
    return apiClient.get(`/data/users/${id}`);
  },
  products(id, page = 1) {
    return apiClient.get(`/data/users/${id}/products`, [`page.${page}`]);
  },
  userProducts(id) {
    return apiClient.get(`/data/users/${id}/user-products`);
  }
};
