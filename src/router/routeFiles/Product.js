export const routes = [
    {
        path: "/products",
        name: "products",
    },
    {
        path: "/product/request",
        name: "requestProduct",
    },
    {
        path: "/products/category/:id",
        name: "productsByCategory",
    },
    {
        path: "/product/:id",
        name: "singleProduct",
        meta: {
            requireAuth: true,
        },
    },
];
