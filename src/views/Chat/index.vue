<template>
  <div class="dash-chat row" id="chat">
    <div class="ringing-call">
      <div class="avatar-image lg">
        <img src="@/assets/chat-avatar.png" alt="image" />
      </div>
      <div class="ringing-info">
        <div class="contact-name">Hilda Hansen</div>
        <div class="call-status">Call you</div>
      </div>
      <div class="ringing-actions">
        <a href="javascript:void(0)" class="action action-close"
          ><i class="fa fa-times"></i
        ></a>
        <a href="javascript:void(0)" class="action action-answer"
          ><i class="fa fa-phone"></i
        ></a>
      </div>
    </div>
    <!-- chat contact -->
    <div :class="{ 'col-12 col-lg-3': true, show: open }" id="contacts">
      <div class="dash-contacts">
        <span id="close-contacts" @click="open = false"
          ><i class="fa fa-times"></i
        ></span>
        <div class="dash-contacts-search">
          <div class="icon">
            <font-awesome-component
              :bold="false"
              icon="search"
            ></font-awesome-component>
          </div>
          <input placeholder="Search Message" />
        </div>
        <ul class="dash-list-contacts">
          <li class="dash-contact-item active">
            <a href="javascript:void(0)" class="contanct">
              <div class="row contact-name-message">
                <div class="col-2">
                  <div class="dash-contact-image">
                    <img src="@/assets/contact-image.png" />
                  </div>
                </div>
                <div class="col-7">
                  <div class="contact-name px-1 py-0 m-0">Ricardo Lopez</div>
                </div>
                <div class="col-3">
                  <div class="contact-last-messages-time">11:23 am</div>
                </div>
              </div>
              <div class="row contact-time-count">
                <div class="col-7 offset-2">
                  <div class="contact-last-message">
                    Three Ways To Get Travel…
                  </div>
                </div>
                <div class="col-3">
                  <div class="contact-last-messages-count">4</div>
                </div>
              </div>
            </a>
          </li>
          <li class="dash-contact-item">
            <a href="javascript:void(0)" class="contanct">
              <div class="row contact-name-message">
                <div class="col-2">
                  <div class="dash-contact-image">
                    <img src="@/assets/contact-image.png" alt="image" />
                  </div>
                </div>
                <div class="col-7">
                  <div class="contact-name px-1 py-0 m-0">Ricardo Lopez</div>
                </div>
                <div class="col-3">
                  <div class="contact-last-messages-time">11:23 am</div>
                </div>
              </div>
              <div class="row contact-time-count">
                <div class="col-7 offset-2">
                  <div class="contact-last-message">
                    Three Ways To Get Travel…
                  </div>
                </div>
                <div class="col-3">
                  <div class="contact-last-messages-count">4</div>
                </div>
              </div>
            </a>
          </li>
          <li class="dash-contact-item">
            <a href="javascript:void(0)" class="contanct">
              <div class="row contact-name-message">
                <div class="col-2">
                  <div class="dash-contact-image">
                    <img src="@/assets/contact-image.png" alt="image" />
                  </div>
                </div>
                <div class="col-7">
                  <div class="contact-name px-1 py-0 m-0">Ricardo Lopez</div>
                </div>
                <div class="col-3">
                  <div class="contact-last-messages-time">11:23 am</div>
                </div>
              </div>
              <div class="row contact-time-count">
                <div class="col-7 offset-2">
                  <div class="contact-last-message">
                    Three Ways To Get Travel…
                  </div>
                </div>
                <div class="col-3">
                  <div class="contact-last-messages-count">4</div>
                </div>
              </div>
            </a>
          </li>
          <li class="dash-contact-item">
            <a href="javascript:void(0)" class="contanct">
              <div class="row contact-name-message">
                <div class="col-2">
                  <div class="dash-contact-image">
                    <img src="@/assets/contact-image.png" alt="image" />
                  </div>
                </div>
                <div class="col-7">
                  <div class="contact-name px-1 py-0 m-0">Ricardo Lopez</div>
                </div>
                <div class="col-3">
                  <div class="contact-last-messages-time">11:23 am</div>
                </div>
              </div>
              <div class="row contact-time-count">
                <div class="col-7 offset-2">
                  <div class="contact-last-message">
                    Three Ways To Get Travel…
                  </div>
                </div>
                <div class="col-3">
                  <div class="contact-last-messages-count">4</div>
                </div>
              </div>
            </a>
          </li>
          <li class="dash-contact-item">
            <a href="javascript:void(0)" class="contanct">
              <div class="row contact-name-message">
                <div class="col-2">
                  <div class="dash-contact-image">
                    <img src="@/assets/contact-image.png" alt="image" />
                  </div>
                </div>
                <div class="col-7">
                  <div class="contact-name px-1 py-0 m-0">Ricardo Lopez</div>
                </div>
                <div class="col-3">
                  <div class="contact-last-messages-time">11:23 am</div>
                </div>
              </div>
              <div class="row contact-time-count">
                <div class="col-7 offset-2">
                  <div class="contact-last-message">
                    Three Ways To Get Travel…
                  </div>
                </div>
                <div class="col-3">
                  <div class="contact-last-messages-count">4</div>
                </div>
              </div>
            </a>
          </li>
          <li class="dash-contact-item">
            <a href="javascript:void(0)" class="contanct">
              <div class="row contact-name-message">
                <div class="col-2">
                  <div class="dash-contact-image">
                    <img src="@/assets/contact-image.png" />
                  </div>
                </div>
                <div class="col-7">
                  <div class="contact-name px-1 py-0 m-0">Ricardo Lopez</div>
                </div>
                <div class="col-3">
                  <div class="contact-last-messages-time">11:23 am</div>
                </div>
              </div>
              <div class="row contact-time-count">
                <div class="col-7 offset-2">
                  <div class="contact-last-message">
                    Three Ways To Get Travel…
                  </div>
                </div>
                <div class="col-3">
                  <div class="contact-last-messages-count">4</div>
                </div>
              </div>
            </a>
          </li>
          <li class="dash-contact-item">
            <a href="javascript:void(0)" class="contanct">
              <div class="row contact-name-message">
                <div class="col-2">
                  <div class="dash-contact-image">
                    <img src="@/assets/contact-image.png" />
                  </div>
                </div>
                <div class="col-7">
                  <div class="contact-name px-1 py-0 m-0">Ricardo Lopez</div>
                </div>
                <div class="col-3">
                  <div class="contact-last-messages-time">11:23 am</div>
                </div>
              </div>
              <div class="row contact-time-count">
                <div class="col-7 offset-2">
                  <div class="contact-last-message">
                    Three Ways To Get Travel…
                  </div>
                </div>
                <div class="col-3">
                  <div class="contact-last-messages-count">4</div>
                </div>
              </div>
            </a>
          </li>
          <li class="dash-contact-item">
            <a href="javascript:void(0)" class="contanct">
              <div class="row contact-name-message">
                <div class="col-2">
                  <div class="dash-contact-image">
                    <img src="@/assets/contact-image.png" />
                  </div>
                </div>
                <div class="col-7">
                  <div class="contact-name px-1 py-0 m-0">Ricardo Lopez</div>
                </div>
                <div class="col-3">
                  <div class="contact-last-messages-time">11:23 am</div>
                </div>
              </div>
              <div class="row contact-time-count">
                <div class="col-7 offset-2">
                  <div class="contact-last-message">
                    Three Ways To Get Travel…
                  </div>
                </div>
                <div class="col-3">
                  <div class="contact-last-messages-count">4</div>
                </div>
              </div>
            </a>
          </li>
          <li class="dash-contact-item">
            <a href="javascript:void(0)" class="contanct">
              <div class="row contact-name-message">
                <div class="col-2">
                  <div class="dash-contact-image">
                    <img src="@/assets/contact-image.png" />
                  </div>
                </div>
                <div class="col-7">
                  <div class="contact-name px-1 py-0 m-0">Ricardo Lopez</div>
                </div>
                <div class="col-3">
                  <div class="contact-last-messages-time">11:23 am</div>
                </div>
              </div>
              <div class="row contact-time-count">
                <div class="col-7 offset-2">
                  <div class="contact-last-message">
                    Three Ways To Get Travel…
                  </div>
                </div>
                <div class="col-3">
                  <div class="contact-last-messages-count">4</div>
                </div>
              </div>
            </a>
          </li>
          <li class="dash-contact-item">
            <a href="javascript:void(0)" class="contanct">
              <div class="row contact-name-message">
                <div class="col-2">
                  <div class="dash-contact-image">
                    <img src="@/assets/contact-image.png" />
                  </div>
                </div>
                <div class="col-7">
                  <div class="contact-name px-1 py-0 m-0">Ricardo Lopez</div>
                </div>
                <div class="col-3">
                  <div class="contact-last-messages-time">11:23 am</div>
                </div>
              </div>
              <div class="row contact-time-count">
                <div class="col-7 offset-2">
                  <div class="contact-last-message">
                    Three Ways To Get Travel…
                  </div>
                </div>
                <div class="col-3">
                  <div class="contact-last-messages-count">4</div>
                </div>
              </div>
            </a>
          </li>
        </ul>
      </div>
      <div class="overlay" @click="open = false"></div>
    </div>
    <!--  -->
    <!-- chat-box -->
    <div class="col-12 col-lg-6">
      <div class="chat-box chatBox" id="chat-box">
        <div class="chat-box-header">
          <button id="open-contacts" class="dash-btn sm" @click="open = true">
            <span>Contacts</span>
          </button>
          <div class="avatar-image">
            <img src="@/assets/chat-avatar.png" />
          </div>
          <div class="chat-box-contact">Hilda Hansen</div>
          <div class="chat-box-order">#123456</div>
          <div class="break"></div>
          <div class="chat-box-menu dash-has-menu">
            <div class="chat-box-icon">
              <i class="fas fa-ellipsis-v"></i>
              <ul class="dash-sub-menu">
                <li class="dash-sub-menu-item">
                  <a href="javascript:void(0)">Create An Agreement</a>
                </li>
                <li class="dash-sub-menu-item">
                  <a href="javascript:void(0)">Send File </a>
                </li>
                <li class="dash-sub-menu-item">
                  <a href="javascript:void(0)">Reporting</a>
                </li>
              </ul>
            </div>
          </div>
          <button
            id="open-agreements"
            class="dash-btn sm"
            @click="open2 = true"
          >
            <span>Attachments</span>
          </button>
        </div>
        <div class="chat-box-content">
          <div class="chat-time-line">
            <span>16-12-2021</span>
          </div>
          <div class="chat-box-sender">
            <div class="avatar-image">
              <img src="@/assets/chat-avatar.png" />
            </div>
            <div class="content-chat-text">
              Now, if you are interested in being the best player, getting
              really good money and knowing some tricks and advices of what to
              do in a live tournament games, here is the best place to learn
              them.
            </div>
            <div class="send-message-time">07:44 am</div>
          </div>

          <div class="chat-box-reciver">
            <div class="avatar-image">
              <img src="@/assets/chat-avatar.png" />
            </div>
            <div class="content-chat-text">Some message text</div>
            <div class="send-message-time">07:44 am</div>
          </div>

          <div class="chat-box-sender">
            <div class="avatar-image">
              <img src="@/assets/chat-avatar.png" />
            </div>
            <div class="content-chat-text">Become A Travel Pro In One Easy</div>
            <div class="send-message-time">07:44 am</div>
          </div>

          <div class="chat-time-line missed">
            <div class="missed">
              <span>08:43 am</span>
              <span>Missed call from you</span>
            </div>
          </div>
          <div class="chat-time-line call">
            <div>
              <span>08:43 am</span>
              <span>you called sam </span>
            </div>
          </div>
          <div class="chat-time-line">
            <div>
              <span>08:43 am</span>
              <span>you called sam </span>
            </div>
          </div>

          <div class="chat-box-sender">
            <div class="avatar-image">
              <img src="@/assets/chat-avatar.png" />
            </div>
            <div class="content-chat-text">
              <p>
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                diam nonumy eirmod tempor invidunt ut labore et dolore magna
                aliquyam erat, sed diam voluptua. At vero eos et accusam et
                justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea
              </p>
              <div class="content-chat-images">
                <div class="image">
                  <img src="@/assets/chat-image.png" />
                </div>
                <div class="image">
                  <img src="@/assets/chat-image.png" />
                </div>
                <div class="image">
                  <img src="@/assets/chat-image.png" />
                </div>
                <div class="image">
                  <img src="@/assets/chat-image.png" />
                </div>
              </div>
            </div>
            <div class="send-message-time">07:44 am</div>
          </div>

          <div class="chat-box-reciver">
            <div class="avatar-image">
              <img src="@/assets/chat-avatar.png" />
            </div>
            <div class="content-chat-text">
              <div class="content-chat-images">
                <div class="image">
                  <img src="@/assets/chat-image.png" />
                </div>
              </div>
            </div>
            <div class="send-message-time">07:44 am</div>
          </div>

          <div class="chat-box-reciver">
            <div class="avatar-image">
              <img src="@/assets/chat-avatar.png" />
            </div>
            <div class="content-chat-text">
              <p>
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                diam nonumy eirmod tempor invidunt ut labore et dolore magna
                aliquyam erat, sed diam voluptua. At vero eos et accusam et
                justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea
              </p>
              <div class="content-chat-images">
                <div class="image">
                  <img src="@/assets/chat-image.png" />
                </div>
                <div class="image">
                  <img src="@/assets/chat-image.png" />
                </div>
                <div class="image">
                  <img src="@/assets/chat-image.png" />
                </div>
                <div class="image">
                  <img src="@/assets/chat-image.png" />
                </div>
              </div>
            </div>
            <div class="send-message-time">07:44 am</div>
          </div>

          <div class="chat-box-reciver">
            <div class="avatar-image">
              <img src="@/assets/chat-avatar.png" />
            </div>
            <div class="content-chat-text">
              <h5 class="agreemnet-title">Create An Agreement</h5>
              <div class="agreement-details">
                <div class="detail">
                  <span class="key">Agreement Details :</span>
                  Sit Ametlorem Ipsum Dolor Sit Ametsit Amet Lorem Ipsum Dolor
                  Sit Amet, Consetetur Sadipscing Elitr, Sed Diam Nonumy Eirmod
                  Tempor Invidunt Ut Labore Et Dolore Magna Aliquyam Erat, Sed
                  Diam Voluptua. At Vero Eos Et Accusam Et Justo Duo Dolores Et
                  Ea Rebum. Stet Clita Kasd Gubergren, No Sea Takimata Sanctus
                  Est Lorem Ipsum Dolor Sit Amet. Lorem Ipsum Dolor Sit Amet,
                  Consetetur
                </div>
                <div class="detail">
                  <span class="key">Price :</span>
                  500$
                </div>
                <div class="detail">
                  <span class="key">The Type Of Files To Be Delivered:</span>
                  Xd, Ai,Pdf,Png,Email,Password,Psd, Open Corse Cood
                </div>
                <div class="detail">
                  <span class="key">Notes :</span>
                  Sit Ametlorem Ipsum Dolor Sit Ametsit Ametsit Ametlorem Ipsum
                  Dolor Sit Ametsit Amet Lorem Ipsum Dolor Sit Amet, Consetetur
                  Sadipscing Elitr, Sed Diam Nonumy Eirmod Tempor Invidunt Ut
                  Labore Et Dolore Magna Aliquyam Erat, Sed Diam Voluptua. At
                  Vero Eos Et Accusam Et Justo Duo Dolores Et Ea Rebum. Stet
                  Clita Kasd Gubergren, No Sea Takimata Sanctus Est Lorem Ipsum
                  Dolor Sit Amet. Lorem Ipsum Dolor Sit Amet, Consetetur
                </div>
                <div class="detail center">
                  <span class="key">Waiting For Approval</span>
                </div>
              </div>
            </div>
            <div class="send-message-time">07:44 am</div>
          </div>

          <div class="chat-box-sender">
            <div class="avatar-image">
              <img src="@/assets/chat-avatar.png" />
            </div>
            <div class="content-chat-text">
              <h5 class="agreemnet-title">Create An Agreement</h5>
              <div class="agreement-details">
                <div class="detail">
                  <span class="key">Agreement Details :</span>
                  Sit Ametlorem Ipsum Dolor Sit Ametsit Amet Lorem Ipsum Dolor
                  Sit Amet, Consetetur Sadipscing Elitr, Sed Diam Nonumy Eirmod
                  Tempor Invidunt Ut Labore Et Dolore Magna Aliquyam Erat, Sed
                  Diam Voluptua. At Vero Eos Et Accusam Et Justo Duo Dolores Et
                  Ea Rebum. Stet Clita Kasd Gubergren, No Sea Takimata Sanctus
                  Est Lorem Ipsum Dolor Sit Amet. Lorem Ipsum Dolor Sit Amet,
                  Consetetur
                </div>
                <div class="detail">
                  <span class="key">Price :</span>
                  500$
                </div>
                <div class="detail">
                  <span class="key">The Type Of Files To Be Delivered:</span>
                  Xd, Ai,Pdf,Png,Email,Password,Psd, Open Corse Cood
                </div>
                <div class="detail">
                  <span class="key">Notes :</span>
                  Sit Ametlorem Ipsum Dolor Sit Ametsit Ametsit Ametlorem Ipsum
                  Dolor Sit Ametsit Amet Lorem Ipsum Dolor Sit Amet, Consetetur
                  Sadipscing Elitr, Sed Diam Nonumy Eirmod Tempor Invidunt Ut
                  Labore Et Dolore Magna Aliquyam Erat, Sed Diam Voluptua. At
                  Vero Eos Et Accusam Et Justo Duo Dolores Et Ea Rebum. Stet
                  Clita Kasd Gubergren, No Sea Takimata Sanctus Est Lorem Ipsum
                  Dolor Sit Amet. Lorem Ipsum Dolor Sit Amet, Consetetur
                </div>
              </div>
              <div class="agreement-actions">
                <button class="dash-btn btn-accept">Acceptance</button>
                <button class="dash-btn btn-cancel">Cancle</button>
              </div>
            </div>
            <div class="send-message-time">07:44 am</div>
          </div>

          <div class="chat-box-sender">
            <div class="avatar-image">
              <img src="@/assets/chat-avatar.png" />
            </div>
            <div class="content-chat-text">
              <h5 class="agreemnet-title">Create An Agreement</h5>
              <div class="agreement-details">
                <div class="detail">
                  <span class="key">Agreement Details :</span>
                  Sit Ametlorem Ipsum Dolor Sit Ametsit Amet Lorem Ipsum Dolor
                  Sit Amet, Consetetur Sadipscing Elitr, Sed Diam Nonumy Eirmod
                  Tempor Invidunt Ut Labore Et Dolore Magna Aliquyam Erat, Sed
                  Diam Voluptua. At Vero Eos Et Accusam Et Justo Duo Dolores Et
                  Ea Rebum. Stet Clita Kasd Gubergren, No Sea Takimata Sanctus
                  Est Lorem Ipsum Dolor Sit Amet. Lorem Ipsum Dolor Sit Amet,
                  Consetetur
                </div>
                <div class="detail">
                  <span class="key">Price :</span>
                  500$
                </div>
                <div class="detail">
                  <span class="key">The Type Of Files To Be Delivered:</span>
                  Xd, Ai,Pdf,Png,Email,Password,Psd, Open Corse Cood
                </div>
                <div class="detail">
                  <span class="key">Notes :</span>
                  Sit Ametlorem Ipsum Dolor Sit Ametsit Ametsit Ametlorem Ipsum
                  Dolor Sit Ametsit Amet Lorem Ipsum Dolor Sit Amet, Consetetur
                  Sadipscing Elitr, Sed Diam Nonumy Eirmod Tempor Invidunt Ut
                  Labore Et Dolore Magna Aliquyam Erat, Sed Diam Voluptua. At
                  Vero Eos Et Accusam Et Justo Duo Dolores Et Ea Rebum. Stet
                  Clita Kasd Gubergren, No Sea Takimata Sanctus Est Lorem Ipsum
                  Dolor Sit Amet. Lorem Ipsum Dolor Sit Amet, Consetetur
                </div>
                <div class="detail center">
                  <span class="key">It Has Been Accepted</span>
                </div>
              </div>
            </div>
            <div class="send-message-time">07:44 am</div>
          </div>

          <div class="chat-box-sender">
            <div class="avatar-image">
              <img src="@/assets/chat-avatar.png" />
            </div>
            <div class="content-chat-text">
              <h5 class="agreemnet-title">Create An Agreement</h5>
              <div class="agreement-details">
                <div class="detail">
                  <span class="key">Agreement Details :</span>
                  Sit Ametlorem Ipsum Dolor Sit Ametsit Amet Lorem Ipsum Dolor
                  Sit Amet, Consetetur Sadipscing Elitr, Sed Diam Nonumy Eirmod
                  Tempor Invidunt Ut Labore Et Dolore Magna Aliquyam Erat, Sed
                  Diam Voluptua. At Vero Eos Et Accusam Et Justo Duo Dolores Et
                  Ea Rebum. Stet Clita Kasd Gubergren, No Sea Takimata Sanctus
                  Est Lorem Ipsum Dolor Sit Amet. Lorem Ipsum Dolor Sit Amet,
                  Consetetur
                </div>

                <div class="detail">
                  <div class="content-chat-images">
                    <div class="image">
                      <img src="@/assets/chat-file.png" />
                    </div>
                    <div class="image">
                      <img src="@/assets/chat-file.png" />
                    </div>
                    <div class="image">
                      <img src="@/assets/chat-file.png" />
                    </div>
                    <div class="image">
                      <img src="@/assets/chat-file.png" />
                    </div>
                  </div>
                </div>

                <div class="detail">
                  <span class="key">Emails, Passwords, And Written Files</span>
                  Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr, Sed
                  Diam Nonumy Eirmod Tempor Invidunt Ut Labore Et Dolore Magna
                  Aliquyam Erat, Sed Diam Voluptua. At Vero Eos Et Accusam Et
                  Justo Duo Dolores Et Ea Rebum. Stet Clita Kasd Gubergren, No
                  Sea Takimata Sanctus Est Lorem Ipsum Dolor Sit Amet. Lorem
                  Ipsum Dolor Sit Amet, Consetetur
                </div>
              </div>
              <div class="agreement-actions">
                <button class="dash-btn btn-accept">Acceptance</button>
                <button class="dash-btn btn-cancel">Cancle</button>
              </div>
            </div>
            <div class="send-message-time">07:44 am</div>
          </div>

          <div class="chat-box-sender">
            <div class="avatar-image">
              <img src="@/assets/chat-avatar.png" />
            </div>
            <div class="content-chat-text">
              <h5 class="agreemnet-title">Create An Agreement</h5>
              <div class="agreement-details">
                <div class="detail">
                  <span class="key">Agreement Details :</span>
                  Sit Ametlorem Ipsum Dolor Sit Ametsit Amet Lorem Ipsum Dolor
                  Sit Amet, Consetetur Sadipscing Elitr, Sed Diam Nonumy Eirmod
                  Tempor Invidunt Ut Labore Et Dolore Magna Aliquyam Erat, Sed
                  Diam Voluptua. At Vero Eos Et Accusam Et Justo Duo Dolores Et
                  Ea Rebum. Stet Clita Kasd Gubergren, No Sea Takimata Sanctus
                  Est Lorem Ipsum Dolor Sit Amet. Lorem Ipsum Dolor Sit Amet,
                  Consetetur
                </div>

                <div class="detail">
                  <div class="content-chat-images">
                    <div class="image">
                      <img src="@/assets/chat-file.png" />
                    </div>
                    <div class="image">
                      <img src="@/assets/chat-file.png" />
                    </div>
                    <div class="image">
                      <img src="@/assets/chat-file.png" />
                    </div>
                    <div class="image">
                      <img src="@/assets/chat-file.png" />
                    </div>
                  </div>
                </div>

                <div class="detail">
                  <span class="key">Emails, Passwords, And Written Files</span>
                  Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr, Sed
                  Diam Nonumy Eirmod Tempor Invidunt Ut Labore Et Dolore Magna
                  Aliquyam Erat, Sed Diam Voluptua. At Vero Eos Et Accusam Et
                  Justo Duo Dolores Et Ea Rebum. Stet Clita Kasd Gubergren, No
                  Sea Takimata Sanctus Est Lorem Ipsum Dolor Sit Amet. Lorem
                  Ipsum Dolor Sit Amet, Consetetur
                </div>
                <div class="detail center">
                  <span class="key">It Has Been Accepted</span>
                </div>
              </div>
            </div>
            <div class="send-message-time">07:44 am</div>
          </div>
        </div>
        <div class="chat-box-footer">
          <ul class="footer-options">
            <li class="option">
              <a href="javaascript:void(0)"><i class="fa fa-video"></i></a>
            </li>
            <li class="option">
              <a href="javaascript:void(0)"><i class="fa fa-phone"></i></a>
            </li>
            <li class="option">
              <a href="javaascript:void(0)"><i class="fa fa-file"></i></a>
            </li>
          </ul>
          <div class="footer-text-message">
            <input placeholder="Type Something" />
            <a href="javascript:void(0)" class="icon"
              ><i class="fa-telegram-plane fab"></i
            ></a>
          </div>
        </div>
      </div>
    </div>
    <!--  -->
    <!-- chat-attachment -->
    <div :class="{ 'col-12 col-lg-3': true, show: open2 }" id="attachment">
      <div class="overlay" @click="open2 = false"></div>
      <div class="chat-attachment">
        <span id="close-agreements" @click="open2 = false"
          ><i class="fa fa-times"></i
        ></span>
        <div class="chat-product">
          <div class="product-info">
            <div class="product-title-and-price">
              <div class="product-title">Name Product ..........T</div>
              <div class="product-price-discount">
                <span class="product-price">200$</span>
                <span class="product-old-price">350$</span>
              </div>
            </div>
            <div class="product-action-and-order">
              <button class="dash-btn product-btn">Stop Selling</button>
              <span class="product-order">#3123</span>
            </div>
          </div>
          <div class="product-details">
            Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr, Sed Diam
            Nonumy Eirmod Tempor Invidunt Ut Labore
          </div>
        </div>
        <div class="chat-attachment-tabs">
          <ul class="tabs-links">
            <li @click="step = 1">
              <a :class="{ link: true, active: step == 1 }">Agreemnts</a>
            </li>
            <li @click="step = 2">
              <a :class="{ link: true, active: step == 2 }">Files</a>
            </li>
            <li @click="step = 3">
              <a :class="{ link: true, active: step == 3 }">Rules</a>
            </li>
          </ul>
          <div>
            <!-- step -1 -->
            <div class="agreemet-tab" v-if="step == 1">
              <div class="dash-agreement">
                <div class="agreement-title">Agreement Details</div>
                <p class="agreement-details">
                  Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr,
                  <button class="dash-btn read-agreement-btn">
                    Read Agreement
                  </button>
                </p>
              </div>
              <div class="dash-agreement">
                <div class="agreement-title">Agreement Details</div>
                <p class="agreement-details">
                  Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr,
                  <button class="dash-btn read-agreement-btn">
                    Read Agreement
                  </button>
                </p>
              </div>
              <div class="dash-agreement">
                <div class="agreement-title">Agreement Details</div>
                <p class="agreement-details">
                  Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr,
                  <button class="dash-btn read-agreement-btn">
                    Read Agreement
                  </button>
                </p>
              </div>
            </div>
            <!-- step -2 -->
            <div class="agreemet-tab" v-if="step == 2">
              <div class="dash-agreement">
                <div class="agreement-title">Note</div>
                <p class="agreement-details">
                  Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr,
                  <button class="dash-btn read-agreement-btn">open file</button>
                </p>
              </div>
              <div class="dash-agreement">
                <div class="agreement-title">Note</div>
                <p class="agreement-details">
                  Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr,
                  <button class="dash-btn read-agreement-btn">open file</button>
                </p>
              </div>
              <div class="dash-agreement">
                <div class="agreement-title">Note</div>
                <p class="agreement-details">
                  Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr,
                  <button class="dash-btn read-agreement-btn">open file</button>
                </p>
              </div>
            </div>
            <!-- step -3 -->
            <div class="agreemet-tab" v-if="step == 3">
              <div class="dash-agreement">
                <div class="agreement-title">Name Rules .....</div>
                <p class="agreement-details">
                  Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr,
                  <button class="dash-btn read-agreement-btn">
                    Read Rules
                  </button>
                </p>
              </div>
              <div class="dash-agreement">
                <div class="agreement-title">Name Rules .....</div>
                <p class="agreement-details">
                  Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr,
                  <button class="dash-btn read-agreement-btn">
                    Read Rules
                  </button>
                </p>
              </div>
              <div class="dash-agreement">
                <div class="agreement-title">Name Rules .....</div>
                <p class="agreement-details">
                  Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr,
                  <button class="dash-btn read-agreement-btn">
                    Read Rules
                  </button>
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="dash-hsitory-calls">
          <div class="history-call missed">
            <div class="image">
              <img src="@/assets/chat-avatar.png" />
            </div>
            <div class="history-call-info">
              <div class="history-call-contact">Hilda Hansen</div>
              <div class="history-call-status">
                <span class="history-call-text">Missed Call From You</span>
                <span class="history-call-time">08:43 Am</span>
              </div>
            </div>
            <div class="history-call-icon">
              <i class="fa fa-phone-slash"></i>
            </div>
          </div>
          <div class="history-call">
            <div class="image">
              <img src="@/assets/chat-avatar.png" />
            </div>
            <div class="history-call-info">
              <div class="history-call-contact">Hilda Hansen</div>
              <div class="history-call-status">
                <span class="history-call-text">Missed Call From You</span>
                <span class="history-call-time">08:43 Am</span>
              </div>
            </div>
            <div class="history-call-icon">
              <i class="fa fa-phone"></i>
            </div>
          </div>
          <div class="history-call">
            <div class="image">
              <img src="@/assets/chat-avatar.png" />
            </div>
            <div class="history-call-info">
              <div class="history-call-contact">Hilda Hansen</div>
              <div class="history-call-status">
                <span class="history-call-text">Missed Call From You</span>
                <span class="history-call-time">08:43 Am</span>
              </div>
            </div>
            <div class="history-call-icon">
              <i class="fa fa-phone"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      open: false,
      open2: false,
      step: 1,
    };
  },
  mounted() {
    document.getElementById("chat").style.height =
      window.innerHeight - 92 + "px";
  },
};
</script>

<style lang="css" scoped src="./chat.css"></style>
