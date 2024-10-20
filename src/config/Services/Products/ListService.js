import apiClient from "@/config/axios";
import store from "@/store";

export default {
  list(page, category = 0) {
    return apiClient.get(
      "/products/list" + (category === 0 ? "" : "/" + category),
      ["page." + page]
    );
  },
  single(id) {
    return apiClient.get("/products/single/" + id);
  },
  similar(catId) {
    return apiClient.get("/products/similar/" + catId)
  },
  best() {
    return apiClient.get("/products/best");
  },
  addProduct(product) {
    return apiClient.post("/products/add", product)
  },
  edit(id) {
    return apiClient.get("/products/edit/" + id);
  },
  update(id, product) {
    console.log(product);
    return apiClient.post(`/products/edit/${id}/publish`, product)
  },
  LikeProduct(id) {
    return apiClient.get(`/products/single/${id}/like`, [
      "user_id." + store.state.user.data.id,
    ])
  }
};
