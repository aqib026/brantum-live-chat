<template>
    <div class="space-a position-relative  p-0">
        <div class="nav-space d-flex align-items-center shadow">
            <div class="user-info">
                <img src="assets/images/chat (2).jpg" class="img-thumbnail" alt="">
                <strong> <small class="fw-normal">online</small> {{ founder.name }}</strong>
            </div>
            <div class="dropdown ms-auto">
                <button class="btn dropdown-toggle shadow-none" type="button" @click.prevent="openToggle"
                    id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <ul class="dropdown-menu" :class="show == true ? 'show' : ''" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#" @click.prevent="close">close</a></li>

                </ul>
            </div>
        </div>
        <div class="chat-padd">
            <div class="msg_card_body" style="height:calc(100vh - 250px)" v-chat-scroll>

                <template v-for="(chat, index) in chats">
                <!-- <div :class="messageClass(chat.type)"   class="" >
                    <div>
                      <p class="m-0">{{ chat.message }}</p>
                      <small>9h ago</small>
                    </div>  
                    <div class="chat-pic position-relative">
                       <img :src="'../../assets/images/chat (2).jpg'" class="rounded-circle" alt="">
                        <span class="style-chat position-absolute bottom-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle">
                          <span class="visually-hidden">New alerts</span>
                        </span>
                    </div>                    
                  </div> -->
               
                    <div :class="messageClass(chat.type)" class="" :key="index">
                        <div>
                            <p class="m-0">{{ chat.message }}</p>
                            <small>9h ago</small>
                        </div>
                        <div class="chat-pic position-relative">
                            <img :src="'../../assets/images/chat (2).jpg'" class="rounded-circle" alt="">
                            <span
                                class="style-chat position-absolute bottom-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle">
                                <span class="visually-hidden">New alerts</span>
                            </span>
                        </div>
                    </div>
                </template>

            </div>
            <div class="footer">
                <div class="footer-text d-flex">
                    <div class="icon-1">
                        <i class="fa-solid fa-paperclip"></i>
                    </div>
                    <div class="footer-2 position-relative">
                        <input class="form-control" @keyup.enter="sendMessage()" type="text"
                            placeholder="Enter your message here" aria-label="default input example" v-model="message">
                        <div class="footer-3 ">
                            <i class=" position-absolute fa-solid fa-face-smile"></i>
                        </div>
                    </div>
                    <div class="footer-btn position-relative">
                        <button type="button" @click="sendMessage()" class=" style-footer btn btn-primary">Send</button>
                        <i class="position-absolute fa-solid fa-paper-plane"></i>
                    </div>
                </div>

            </div>
        </div>

    </div>
</template>
<style scoped>
.msg_card_body {
    overflow-y: scroll;
}

.nav-space {
    background-color: white;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    padding: 5px;
}

.dropdown-toggle::after {
    border: none !important;
}

.dropdown-menu {
    position: absolute !important;
    left: auto !important;
    right: -6px !important;
}

.user-info img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}

.chat-padd {
    padding: 30px 15px 20px;
}

.show {
    display: block !important;
}
</style>
<script>

export default {
    props: ['user', 'founder'],
    components: {
    },
    data() {
        return {

            message: '',
            chats: [],
            isTyping: false,
            search: '',
            show: 'false',

        }
    },
    methods: {

        openToggle(e) {
            this.show = !this.show
        },
        messageClass: function (type) {
                if(type == 0){
                    return 'chat-2 d-flex justify-content-end position-relative';
                }else{
                    return 'chat-2 d-flex  justify-content-start position-relative';
                }
            },
        sendMessage() {
            if (this.message) {
                this.pushToChats(this.message);
                axios
                    .post(`/send/${this.founder.session.id}`, {
                        content: this.message,
                        to_user: this.founder.id
                    })
                    .then(res => (this.chats[this.chats.length - 1].id = res.data));
                this.message = null;
            }
        },
        pushToChats(message) {
            this.chats.push({
                message: message,
                type: 0,
                read_at: null,
                sent_at: "Just Now"
            });
        },
        close() {
            this.$emit("close");
        },
        clear() {
            axios
                .post(`/session/${this.founder.session.id}/clear`)
                .then(res => (this.chats = []));
        },
        // block() {
        //   this.session.block = true;
        //   axios
        //     .post(`/session/${this.friend.session.id}/block`)
        //     .then(res => (this.session.blocked_by = auth.id));
        // },
        // unblock() {
        //   this.session.block = false;
        //   axios
        //     .post(`/session/${this.friend.session.id}/unblock`)
        //     .then(res => (this.session.blocked_by = null));
        // },
        getAllMessages() {
            axios
                .post(`/session/${this.founder.session.id}/chats`)
                .then(res => (this.chats = res.data.data));
        },
        read() {
            axios.post(`/session/${this.founder.session.id}/read`);
        }
    },
    created() {
        // this.read();
        this.getAllMessages();

    },

};
</script>