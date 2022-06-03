<template>
    <div>

        <div class="space-a position-relative">
            <div class="nav-space d-flex align-items-center shadow">
                <div class="user-info">

                    <span v-html="founder.profile_pic"></span>
                    <strong> {{ founder.name }} <span v-if="isTyping">is Typing . . .</span> <small
                            class="fw-normal text-success" v-if="founder.online">online</small></strong>
                </div>
                <div class="dropdown ms-auto">

                    <button class="btn dropdown-toggle shadow-none" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                        aria-expanded="false" @click.prevent="openToggle">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </button>
                    <a class=" pe-3" @click.prevent="close">
                        <i class="fa-solid text-dark fa fa-close"></i>
                    </a>
                    <ul class="dropdown-menu" :class="show == true ? 'show' : ''" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#" @click.prevent="clear">Clear Chat</a></li>
                        <li><a class="dropdown-item" href="#" v-if="session.block && can"
                                @click.prevent="unblock">UnBlock</a></li>
                        <li><a class="dropdown-item" href="#" @click.prevent="block" v-if="!session.block">Block</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="chat-padd">
                <div class="msg_card_body" style="height:calc(100vh - 250px)" v-chat-scroll>
                    <template v-for="(chat, index) in chats">
                        <div class="d-flex me-3 mt-4" :class="messageClass(chat.type)" :key="index">

                            <div>
                                <p v-if="chat.message" class="m-0">{{ chat.message }}</p>
                                <div v-if="chat.image" class="msg-img">
                                    <img :src="'/assets/' + chat.image" alt="">
                                </div>
                                <span v-if="chat.type == 0" class="d-flex justify-content-end">

                                    <span v-if="chat.read_at == null">
                                        <small>{{ chat.send_at }}</small>
                                        <i class="fa fa-check tick-size"></i>

                                    </span>
                                    <span v-else-if="chat.read_at != null"
                                        :class="{ 'text-success': chat.read_at != null }">
                                        <small>{{ chat.read_at }}</small>
                                        <i class="fa fa-check-double tick-size"></i>
                                    </span>
                                </span>

                            </div>

                        </div>
                    </template>

                </div>
                <div class="chat-app-form mt-5">
                    <div class="chat-app-input d-flex align-items-center position-relative">


                        <!-- <file-upload ref="upload" v-model="files" :post-action="`/send-image/${this.founder.session.id}`" -->
                        <!-- @input-file="inputFile" > -->
                        <!-- <i class="fa-solid fa-paperclip"></i> -->
                        <!-- </file-upload> -->
                        <!-- <file-upload :post-action="`/send-image/${this.founder.session.id}`" ref='upload'
                            v-model="files" @input-file="$refs.upload.active = true"
                            :headers="{ 'X-CSRF-TOKEN': token }" :data="{ to_user: this.founder.id }">
                            <i class="fa-solid fa-paperclip"></i>
                        </file-upload> -->


                        <div class="form-group ">
                            <label class="text-uppercase d-flex align-items-center" for="formFile">
                                <i class="fa-solid fa-paperclip"></i>
                            </label>
                            <input type="file" id="formFile" name="file" v-on:change="onImageChange">
                        </div>
                        <input type="text" class="form-control ms-3 shadow-none position-relative"
                            placeholder="Type your Message here" @keyup.enter="sendMessage()" v-model="message"
                            :disabled="session.block">
                        <i class="fa-solid fa-face-smile"></i>
                        <div class="send-btn position-relative">
                            <button type="button" class="btn btn-primary ms-3" @click="sendMessage()">Send</button>
                            <i class="fa-solid fa-paper-plane"></i>
                        </div>
                    </div>
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
</style>
<script>

export default {
    props: ['founder'],
    components: {
    },
    data() {
        return {

            message: '',
            chats: [],
            isTyping: false,
            show: false,
            file: '',
            token: document.head.querySelector('meta[name="csrf-token"]').content,
            success: '',
            image: '',
        }
    },
    computed: {
        session() {
            return this.founder.session;
        },
        can() {
            return this.session.blocked_by == auth.id;
        }
    },
    // watch: {
    //     files: {
    //         deep: true,
    //         handler() {
    //             let success = this.files[0].success;
    //             if (success) {
    //                 // this.getAllMessages();
    //             }
    //         }
    //     },

    //     '$refs.upload'(val) {
    //         console.log(val);
    //     }
    // },
    methods: {
        onImageChange(e) {
            this.isFile = true;
            this.file = e.target.files[0];
            let existingObj = this;
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            let data = new FormData();
            data.append('file', this.file);
            data.append('to_user', this.founder.id);
            axios.post(`/send-image/${this.founder.session.id}`, data, config)
                .then(res => {
                    this.pushImage(res.data.file);

                });

        },
        openToggle() {
            this.show = !this.show
        },
        messageClass: function (type) {
            if (type == 0) {
                return 'chat-2  justify-content-end position-relative';
            } else {
                return 'chat-2 position-relative align-items-start';
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
        pushImage(message) {
            this.chats.push({
                image: message,
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

        getAllMessages() {
            axios
                .post(`/session/${this.founder.session.id}/chats`)
                .then(res => (this.chats = res.data.data));
        },
        read() {
            axios.post(`/session/${this.founder.session.id}/read`);
        },
        block() {
            this.session.block = true;
            axios
                .post(`/session/${this.founder.session.id}/block`)
                .then(res => (this.session.blocked_by = auth.id));
        },
        unblock() {
            this.session.block = false;
            axios
                .post(`/session/${this.founder.session.id}/unblock`)
                .then(res => (this.session.blocked_by = null));
        }
    },
    created() {
        this.read();
        this.getAllMessages();
        Echo.private(`Chat.${this.founder.session.id}`).listen(
            "PrivateChatEvent",
            e => {
                this.founder.session.open ? this.read() : "";
                if (e.type == '0') {
                    this.chats.push({ image: e.content, type: 1, sent_at: "Just Now" });

                }else if(e.type =='1'){
                    this.chats.push({ message: e.content, type: 1, sent_at: "Just Now" });

                }

            }
        );

        Echo.private(`Chat.${this.founder.session.id}`).listen("MsgReadEvent", e =>
            this.chats.forEach(
                chat => (chat.id == e.chat.id ? (chat.read_at = e.chat.read_at) : "")
            )
        );

        Echo.private(`Chat.${this.founder.session.id}`).listen(
            "BlockEvent",
            e => (this.session.block = e.blocked)
        );

        Echo.private(`Chat.${this.founder.session.id}`).listenForWhisper(
            "typing",
            e => {
                this.isTyping = true;
                setTimeout(() => {
                    this.isTyping = false;
                }, 2000);
            }
        );

    },

};
</script>