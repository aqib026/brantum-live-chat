  <template>
  <section class="first">
            <div class="row">
                <div class="col-md-3">
                  
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="chat-low accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button class="self-paid accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseOne">
                                    Active Conversations
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                                aria-labelledby="panelsStayOpen-headingOne">
                               
                                <div class="accordion-body">
                                    <div class="drop-pic1 d-flex mt-3" v-for="(founder, index) in founders"  :key="index">
                                        <li class="position-relative">
                                            <a class="dropdown-item" href="#" @click.prevent="openChat(founder)">
                                            <span v-html="founder.profile_pic"></span> {{ founder.name }}
                                                <span class="text-danger"
                                                    v-if="founder.session && (founder.session.unreadCount > 0)">{{
                                                            founder.session.unreadCount
                                                    }}</span></a>
                                            <i class="online-class fa fa-circle " v-if="founder.online"></i>
                                        </li>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <span v-for="founder in founders" :key="founder.id">
                        <messages-component :user="user" @close="close(founder)" :founder="founder"
                            v-if="founder.session && founder.session.open"></messages-component>

                    </span>


                </div>
                <div class="col-md-3">
                    <div class="third-lay">
                        <div class="layout">
                            <h2>HB</h2>
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
                        <div class="last-one position-relative">
                            <div class="last-1">
                                <p>Archive</p>
                            </div>
                            <div class="lay-icon">
                                <i class="position-absolute fa-solid fa-box-archive"></i>
                            </div>
                        </div>
                    </div>
                    <div class="final-lay">
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
                                <div class="low-hadding56"></div>
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
                                <button type="button" class="larger-but btn btn-primary btn-lg">
                                    Copy link
                                </button>
                                <!-- </div>
                    <i class=" position-absolute fa-solid fa-link"></i>
               </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section></template>
  