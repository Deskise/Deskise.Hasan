export const mixin = {
    data() {
        return {
            scrolledToBottom: true, // make sure it's set to true
            isLoading: false,
        };
    },
    methods: {
        async scroll(func) {
            window.onscroll = async () => {
                let bottomOfWindow =
                    Math.max(
                        window.pageYOffset,
                        document.documentElement.scrollTop,
                        document.body.scrollTop
                    ) +
                        window.innerHeight ===
                    document.documentElement.offsetHeight;

                if (bottomOfWindow) {
                    if (
                        this.faq.next_page_url !== null &&
                        this.scrolledToBottom
                    ) {
                        this.scrolledToBottom = false;
                        this.isLoading = true;
                        func();
                    }
                }
            };
        },
    },
};
