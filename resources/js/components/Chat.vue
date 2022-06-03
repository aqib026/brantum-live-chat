<template>
    <!-- Dashboard -->
    <div class="header-main">
        <section class="first">
            <div class="">
                <div class="row">
                    <!-- FIRST COLUMN START -->
                    <div class="col-md-3 left-user ">
                        <div class="chat-image d-flex">
                            <img src="assets/images/chat-icon2.png" alt="">
                            <h1>Brantum Live Chat</h1>
                        </div>
                        <div class="chat-logo">
                            <img src="assets/images/hero.jpg" alt="">
                            <div class="chat-text d-flex">
                                <p>Bill Bradford</p>
                                <i class="fa-solid fa-gear"></i>
                            </div>
                            <div class="below-text">
                                <small>Lead UX/UI Designer</small>
                                <div class="form-check form-switch d-flex blue">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckChecked" checked>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
                                </div>
                            </div>
                        </div>
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class=" chat-low accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                    <button class="self-paid accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseOne">
                                        Active Conversations <span></span>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="panelsStayOpen-headingOne">
                                    <div class="accordion-body">

                                        <div class="drop-pic1" v-for="(founder, index) in founders" :key="index">
                                            <li class="d-flex align-items-center">
                                                <a class="dropdown-item d-flex" href="#"
                                                    @click.prevent="openChat(founder)">
                                                    <span v-html="founder.profile_pic">
                                                    </span>
                                                    <div class="drop-dot position-relative">
                                                        <i class="fa fa-circle float-right text-success"
                                                            v-if="founder.online" aria-hidden="true"></i>
                                                    </div>
                                                    <p>{{ founder.name }}</p>



                                                    <span class="message-count"
                                                        v-if="founder.session && (founder.session.unreadCount > 0)">{{
                                                                founder.session.unreadCount
                                                        }}</span>
                                                 

                                                </a>
                                            </li>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="chat-low2 accordion-item">
                            <h2 class=" accordion-header" id="panelsStayOpen-headingTwo">
                                <button class="self-paid accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo"
                                    aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                    Arhived Conversations
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-headingTwo">
                                <div class=" chat-low accordion-body">
                                    <div class="drop-pic1">
                                        <li>
                                            <a class="dropdown-item d-flex" href="#">
                                                <img src="assets/images/chat.jpg" alt="">
                                                <p>Henry Boyd</p>
                                            </a>
                                        </li>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                    </div>
                    <div class="col-md-6">
                        <span v-for="founder in founders" :key="founder.id">
                            <messages-component :user="user" @close="close(founder)" :founder="founder"
                                v-if="founder.session && founder.session.open"></messages-component>

                        </span>
                    </div>
                    <!-- THIRD COLUMN START -->
                    <div class="col-md-3">
                        <div class="third-lay">
                            <div class="layout">

                                <h2>{{ initials(user.name)}}</h2>
                            </div>
                            <div class="lay-1 d-flex">
                                <div class="lay-icon">
                                    <i class="fa-solid fa-envelope-open"></i>
                                </div>
                                <div class="lay-text">
                                    <p>{{ user.email }}</p>
                                </div>
                            </div>
                            <div class="lay-2 d-flex">
                                <div class="lay-icon">
                                    <i class="fa-solid fa-user-tie"></i>
                                </div>
                                <div class="lay-text">
                                    <p>{{ user.name }}</p>
                                </div>
                            </div>
                            <div class="archived-btn position-relative">
                                <button type="submit" class="btn btn-primary ms-3">Archived</button>
                                <i class="position-absolute fa-solid fa-box-archive"></i>
                            </div>
                        </div>
                        <div class="final-lay ">
                            <div class="final-99 d-flex">
                                <div class="final d-flex position-relative">
                                    <div class="final-icon">
                                        <i class="fa-solid fa-clock"></i>
                                    </div>
                                    <div class="final-text">
                                        <p>13h</p>
                                    </div>
                                </div>
                                <div class="gap-lo">
                                    <div class="last-imp d-flex position-relative">
                                        <div class="last-icon">
                                            <i class="fa-solid fa-user-check"></i>
                                        </div>
                                        <div class="last-text">
                                            <p>188</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="stage-00 d-flex">
                                    <div class="stage-1 d-flex position-relative">
                                        <div class="stage-icon">
                                            <i class="fa-solid fa-calendar"></i>
                                        </div>
                                        <div class="stage-text">
                                            <p>119</p>
                                        </div>
                                    </div>
                                    <div class="gap-lo">
                                        <div class="stage-imp d-flex">
                                            <div class="stage-icon3">
                                                <i class="fa-brands fa-rocketchat"></i>
                                            </div>
                                            <div class="stage-text2">
                                                <p>41</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="low-hading">
                                <div class="low-hadingtext d-flex">
                                    <h3>Current Week</h3>
                                    <p>Activity</p>
                                </div>
                                <div class="footer-78 d-flex">
                                    <div class="low-hadding56">
                                    </div>
                                    <div class="low-hadding57"></div>
                                    <div class="low-hadding58"></div>
                                    <div class="low-hadding59"></div>
                                    <div class="low-hadding60"></div>
                                    <div class="low-hadding61"></div>
                                </div>
                            </div>
                        </div>
                        <div class="bottom-2">
                            <div class="bottom-su">
                                <div class="bottom-text">
                                    <h3>Onboard Clients</h3>
                                </div>
                                <div class="bottom-text1">
                                    <p>Share the link with prospects and discuss all stuff</p>
                                </div>
                                <div class="bottom-btn position-relative">
                                    <button type="button" class="larger-but btn btn-primary btn-lg">Copy link</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- THIRD COLUMN END -->
                </div>
                <!-- FIRST COLUMN END -->
            </div>
        </section>
    </div>
    <!-- End Dashboard -->
</template>
<style lang="scss" scoped>
.chatCount {
    margin-left: 5px;
    font-size: 12px;
    font-weight: 600;
    color: #ffffff;
    background: #293b35;
    line-height: 20px;
    text-align: center;
    border-radius: 50%;
    padding: 0 6px;
    height: 20px;
}
</style>
<script>
/**
 * Customers component
 */
import axios from 'axios';
import MessagesComponent from './Messages';

export default {
    props: ['user'],
    components: { MessagesComponent },
    data() {
        return {
            founders: []
        };
    },
    methods: {
        initials(fullName) {
            let arrName = fullName.split(" ");

            let iniName = fullName.charAt(0);

            let iniLname = arrName[arrName.length - 1].charAt(0);

            return iniName + iniLname;
        },
        close(founder) {
            founder.session.open = false
        },

        getUsers() {
            axios.get('/getUsers').then(res => {
                this.founders = res.data.data;
                this.founders.forEach(
                    founder => (founder.session ? this.listenForEverySession(founder) : "")
                );
            });
        },

        openChat(founder) {

            if (founder.session) {
                this.founders.forEach(
                    founder => (founder.session ? (founder.session.open = false) : "")
                );
                founder.session.open = true;
                founder.session.unreadCount = 0;
            } else {
                this.founders.forEach(
                    founder => (founder.session ? (founder.session.open = false) : "")
                );
                this.createSession(founder);
            }
        },

        createSession(founder) {
            axios.post("/session/create", { founder_id: founder.id }).then(res => {
                (founder.session = res.data.data), (founder.session.open = true);
            })
        },
        listenForEverySession(founder) {
            Echo.private(`Chat.${founder.session.id}`).listen(
                "PrivateChatEvent",
                e => (founder.session.open ? "" : founder.session.unreadCount++)
            );
        }
    },
    created() {
        this.getUsers();
        Echo.channel("Chat").listen("SessionEvent", e => {
            let founder = this.founders.find(founder => founder.id == e.session_by);
            founder.session = e.session;
            this.listenForEverySession(founder);
        });

        Echo.join(`Chat`)
            .here((users) => {
                this.founders.forEach(founder => {
                    users.forEach(user => {
                        if (user.id == founder.id) {
                            founder.online = true;
                        }
                    });
                });
            })
            .joining(user => {
                this.founders.forEach(
                    founder => (user.id == founder.id ? (founder.online = true) : "")
                );
            })
            .leaving(user => {
                this.founders.forEach(
                    founder => (user.id == founder.id ? (founder.online = false) : "")
                );
            });
    },
};
</script>