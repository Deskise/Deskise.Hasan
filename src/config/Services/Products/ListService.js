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
};
