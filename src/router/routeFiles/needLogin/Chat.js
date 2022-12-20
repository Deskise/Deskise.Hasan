import DefaultLayout from "@/views/Chat/index";
import CreateAgreement from "@/components/Chat/ChatPopups/CreateAgreement.vue";
import SendFilePopups from "@/components/Chat/ChatPopups/SendFilePopups.vue";
import ReportingPopups from "@/components/Chat/ChatPopups/ReportingPopups.vue";
import store from "@/store";

export const routes = [
  {
    path: "/chat",
    component: DefaultLayout,
    name: "chat",
    beforeEnter: function (routeTo, from, next) {
      store.state.noFooter = true;
      next();
    },
    children: [
      {
        path: "/chat/agreement",
        name: "Agreement",
        component: CreateAgreement,
      },
      { path: "/chat/sendfile", name: "SendFile", component: SendFilePopups },
      {
        path: "/chat/reporting",
        name: "Reporting",
        component: ReportingPopups,
      },
    ],
  },
];
