// import Chat from "@/config/Services/Data/ChatService";

export const namespaced = true;

export const state = {
  chat: [
    {
      id: "1",
      type: "sender",
      image:
        "https://pickaface.net/gallery/avatar/20151205_194059_2696_Chat.png",
      messageType: "text",
      messageContent: "Hello Jameel",
      messageTime: "07:44 am",
    },
    {
      id: "2",
      type: "sender",
      image:
        "https://pickaface.net/gallery/avatar/20151205_194059_2696_Chat.png",
      messageType: "text",
      messageContent: "How Are You",
      messageTime: "07:45 am",
    },
    {
      id: "3",
      type: "receiver",
      image:
        "https://pickaface.net/gallery/avatar/20151205_194059_2696_Chat.png",
      messageType: "text",
      messageContent: "Hello Abood",
      messageTime: "07:50 am",
    },
    {
      id: "4",
      type: "receiver",
      image:
        "https://pickaface.net/gallery/avatar/20151205_194059_2696_Chat.png",
      messageType: "photo",
      messageContent: [
        "https://pickaface.net/gallery/avatar/20151205_194059_2696_Chat.png",
      ],
      messageTime: "07:51 am",
    },
    {
      id: "5",
      type: "sender",
      image:
        "https://pickaface.net/gallery/avatar/20151205_194059_2696_Chat.png",
      messageType: "photo",
      messageContent: [
        "https://pickaface.net/gallery/avatar/20151205_194059_2696_Chat.png",
        "https://pickaface.net/gallery/avatar/20151205_194059_2696_Chat.png",
        "https://pickaface.net/gallery/avatar/20151205_194059_2696_Chat.png",
      ],
      messageTime: "07:55 am",
    },
    {
      id: "6",
      type: "sender",
      image:
        "https://pickaface.net/gallery/avatar/20151205_194059_2696_Chat.png",
      messageType: "textphoto",
      messageText: "Hello Mohammed",
      messageImages: [
        "https://pickaface.net/gallery/avatar/20151205_194059_2696_Chat.png",
        "https://pickaface.net/gallery/avatar/20151205_194059_2696_Chat.png",
        "https://pickaface.net/gallery/avatar/20151205_194059_2696_Chat.png",
      ],
      messageTime: "08:45 am",
    },
    {
      id: "7",
      type: "receiver",
      image:
        "https://pickaface.net/gallery/avatar/20151205_194059_2696_Chat.png",
      messageType: "textphoto",
      messageText: "Hello Mohammed",
      messageImages: [
        "https://pickaface.net/gallery/avatar/20151205_194059_2696_Chat.png",
        "https://pickaface.net/gallery/avatar/20151205_194059_2696_Chat.png",
        "https://pickaface.net/gallery/avatar/20151205_194059_2696_Chat.png",
      ],
      messageTime: "09:45 am",
    },
    {
      id: "8",
      type: "sender",
      image:
        "https://pickaface.net/gallery/avatar/20151205_194059_2696_Chat.png",
      messageType: "agreemnet",
      agreemnetDetails:
        "Sit Ametlorem Ipsum Dolor Sit Ametsit Amet Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr, Sed Diam Nonumy Eirmod Tempor Invidunt Ut Labore Et Dolore Magna Aliquyam Erat, Sed Diam Voluptua. At Vero Eos Et Accusam Et Justo Duo Dolores Et Ea Rebum. Stet Clita Kasd Gubergren,No Sea Takimata Sanctus Est Lorem Ipsum Dolor Sit Amet. Lorem Ipsum Dolor Sit Amet, Consetetur",
      agreemnetPrice: "500$",
      fileType: "Xd, Ai,Pdf,Png,Email,Password,Psd, Open Corse Cood ",
      agreemnetNotes:
        "Sit Ametlorem Ipsum Dolor Sit Ametsit Amet Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr, Sed Diam Nonumy Eirmod Tempor Invidunt Ut Labore Et Dolore Magna Aliquyam Erat, Sed Diam Voluptua. At Vero Eos Et Accusam Et Justo Duo Dolores Et Ea Rebum. Stet Clita Kasd Gubergren,No Sea Takimata Sanctus Est Lorem Ipsum Dolor Sit Amet. Lorem Ipsum Dolor Sit Amet, Consetetur",
      messageTime: "09:55 am",
    },
    {
      id: "9",
      type: "receiver",
      image:
        "https://pickaface.net/gallery/avatar/20151205_194059_2696_Chat.png",
      messageType: "agreemnet",
      agreemnetDetails:
        "Sit Ametlorem Ipsum Dolor Sit Ametsit Amet Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr, Sed Diam Nonumy Eirmod Tempor Invidunt Ut Labore Et Dolore Magna Aliquyam Erat, Sed Diam Voluptua. At Vero Eos Et Accusam Et Justo Duo Dolores Et Ea Rebum. Stet Clita Kasd Gubergren,No Sea Takimata Sanctus Est Lorem Ipsum Dolor Sit Amet. Lorem Ipsum Dolor Sit Amet, Consetetur",
      agreemnetPrice: "500$",
      fileType: "Xd, Ai,Pdf,Png,Email,Password,Psd, Open Corse Cood ",
      agreemnetNotes:
        "Sit Ametlorem Ipsum Dolor Sit Ametsit Amet Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr, Sed Diam Nonumy Eirmod Tempor Invidunt Ut Labore Et Dolore Magna Aliquyam Erat, Sed Diam Voluptua. At Vero Eos Et Accusam Et Justo Duo Dolores Et Ea Rebum. Stet Clita Kasd Gubergren,No Sea Takimata Sanctus Est Lorem Ipsum Dolor Sit Amet. Lorem Ipsum Dolor Sit Amet, Consetetur",
      messageTime: "09:55 am",
    },
    {
      id: "10",
      type: "sender",
      image:
        "https://pickaface.net/gallery/avatar/20151205_194059_2696_Chat.png",
      messageType: "text",
      messageContent: "Ok Thank You",
      messageTime: "09:58 am",
    },
  ],
};

export const mutations = {
  sendMsg1(state, payload) {
    state.chat.push({
      id: "11",
      type: "sender",
      image:
        "https://pickaface.net/gallery/avatar/20151205_194059_2696_Chat.png",
      messageType: "text",
      messageContent: payload,
      messageTime: "07:44 am",
    });
  },
};

export const actions = {
  sendMsg({ commit }, msg) {
    commit("sendMsg1", msg);
  },
};

export const getters = {};
