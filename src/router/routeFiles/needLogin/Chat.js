import DefaultLayout from "@/views/Chat/index";
import CreateAgreement from "@/components/Chat/ChatPopups/CreateAgreement.vue";
import SendFilePopups from "@/components/Chat/ChatPopups/SendFilePopups.vue";
import ReportingPopups from "@/components/Chat/ChatPopups/ReportingPopups.vue";
import SuccessPopups from "@/components/Chat/ChatPopups/SuccessSendReporting.vue";
import store from "@/store";

export const routes = [
  {
    path: "/chat",
    name: "chat",
    beforeEnter: function (routeTo, from, next) {
      store.state.noFooter = true;
        store.dispatch("chat/list").then(() => {
            next({
              name: "chats",
              params: { chatId: store.state.chat.chats[0].id },
            });
          });
    },
  },
  {
    path: "/chats/:chatId",
    component: DefaultLayout,
    name: "chats",
    beforeEnter: function (routeTo, from, next) {
      store.state.noFooter = true;
      // Add bayer, seller and product ids to database from store->product, to be shown in the chat
      store.dispatch("chat/list").then(() => {
        if (store.state.chat.chats.length < 0) {
          routeTo.params.chatId === "first"
        }
        else if (store.state.chat.chats.length) {
          routeTo.params.chatId = store.state.chat.chats[0].id;
        } 
        next();
      });
    },

    children: [
      {
        path: "/chats/:chatId/agreement",
        name: "Agreement",
        component: CreateAgreement,
      },
      {
        path: "/chats/:chatId/sendfile",
        name: "SendFile",
        component: SendFilePopups,
      },
      {
        path: "/chats/:chatId/reporting",
        name: "Reporting",
        component: ReportingPopups,
      },
      {
        path: "/chats/:chatId/reporting/success",
        name: "ReportingSuccess",
        component: SuccessPopups,
      },
    ],
  },
];
