import apiClient from "@/config/axios";

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
    // return apiClient.post("products/update/"+ product.id)
    console.log(product);
    return apiClient.post(`/products/edit/${id}/publish`, product)
  }
};
