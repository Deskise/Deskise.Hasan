import { Vue } from "@/init/";
Vue.directive("date", {
    mounted(el, binding) {
        const d = new Date(binding.value);
        const months = [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
        ];
        console.log(
            months[d.getMonth()] + " " + d.getDate() + ", " + d.getFullYear()
        );

        el.innerText =
            months[d.getMonth()] + " " + d.getDate() + ", " + d.getFullYear();
    },
});
