<?php
require "config.php";

$getContact = $pdo->prepare("SELECT * FROM contacts");
$getContact->execute();
$contacts = $getContact->fetchAll();

if ($contacts) {
    foreach ($contacts as $contact) {
        echo '
            <div class="contact-form" id="contact-form">
                <div class="contact-header">
                    <p>' . $contact['name'] . '</p>
                </div>
                <div class="contact-body" id="' . $contact['id'] . '">
                    <p class="contact-message">' . $contact['message'] . '</p>
                    <p class="contact-email" id="contact-email">- ' . $contact['email'] . ' -</p>
                    <div class="contact-buttons" id="contact-buttons">
                        <button class="cancel-button" id="cancel">Cancel</button>
                        <button class="reply-button" id="reply">Reply</button>
                    </div>

                    <div class="reply-box" id="reply-box">
                        <div class="reply-messsage-box">
                            <textarea cols="30" rows="10" placeholder="Reply as an email..." id="reply-email"></textarea>
                        </div>
                        <div class="reply-send-box">
                            <button class="reply-cancel-button" id="reply-cancel">
                                Cancel
                            </button>
                            <button class="reply-send-button" id="reply-send">
                                Send
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        ';
    }
} else {
    echo '<div class="no-contact" id="no-contact">
            <div class="nc-icon-wrapper">
               <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 22 20"
                  fill="none"
                  x="0px"
                  y="0px"
               >
                  <path
                     fill-rule="evenodd"
                     clip-rule="evenodd"
                     d="M21 0.5H3C2.7 0.5 2.5 0.7 2.5 1V5.5C2.5 5.8 2.7 6 3 6C3.3 6 3.5 5.8 3.5 5.5V2.1C3.6 2.2 3.7 2.3 3.9 2.4C4.6 3 5.6 3.8 6.6 4.6C7.6 5.4 8.7 6.2 9.7 6.9C10.2 7.2 10.6 7.5 11 7.7C11.2 7.8 11.4 7.9 11.5 7.9C11.6 8 11.8 8 12 8C12.2 8 12.4 8 12.5 7.9C12.7 7.8 12.8 7.8 13 7.7C13.4 7.5 13.8 7.2 14.3 6.9C15.2 6.3 16.3 5.5 17.4 4.6C18.4 3.8 19.4 3 20.2 2.4C20.3 2.3 20.5 2.2 20.6 2.1V13.5H10.6C10.3 13.5 10.1 13.7 10.1 14C10.1 14.3 10.3 14.5 10.6 14.5H21C21.3 14.5 21.5 14.3 21.5 14V1C21.5 0.7 21.3 0.5 21 0.5ZM19.5 1.6C18.8 2.2 17.8 3 16.8 3.8C15.8 4.6 14.7 5.4 13.8 6C13.4 6.3 13 6.5 12.6 6.7C12.4 6.8 12.3 6.8 12.2 6.9C12.1 6.9 12 6.9 12 6.9C12 6.9 11.9 6.9 11.8 6.9C11.7 6.9 11.6 6.8 11.4 6.7C11.1 6.5 10.7 6.3 10.2 6C9.3 5.4 8.2 4.6 7.2 3.8C6.2 3 5.2 2.2 4.5 1.6L4.4 1.5H19.7L19.5 1.6Z"
                     fill="black"
                  />
                  <path
                     fill-rule="evenodd"
                     clip-rule="evenodd"
                     d="M5 6.5C2.5 6.5 0.5 8.5 0.5 11C0.5 12.1 0.9 13.2 1.6 14C2.4 14.9 3.6 15.5 5 15.5C7.5 15.5 9.5 13.5 9.5 11C9.5 9.9 9.1 8.8 8.4 8C7.6 7.1 6.3 6.5 5 6.5ZM1.5 11C1.5 9.1 3.1 7.5 5 7.5C5.9 7.5 6.7 7.8 7.3 8.3L2.1 12.9C1.7 12.4 1.5 11.7 1.5 11ZM5 14.5C4.1 14.5 3.3 14.2 2.7 13.7L7.9 9.1C8.3 9.7 8.5 10.3 8.5 11C8.5 12.9 6.9 14.5 5 14.5Z"
                     fill="black"
                  />
                  <text
                     x="0"
                     y="31"
                     fill="#000000"
                     font-size="5px"
                     font-weight="bold"
                     font-family="\'Helvetica Neue\', Helvetica, Arial-Unicode, Arial, Sans-serif"
                  >
                     Created by Chenyu Wang
                  </text>
                  <text
                     x="0"
                     y="36"
                     fill="#000000"
                     font-size="5px"
                     font-weight="bold"
                     font-family="\'Helvetica Neue\', Helvetica, Arial-Unicode, Arial, Sans-serif"
                  >
                     from the Noun Project
                  </text>
               </svg>
            </div>
         </div>';
}