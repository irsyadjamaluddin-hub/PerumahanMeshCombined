




    
    <div class="home-svc-head">
      <h2 class="home-svc-title">Services</h2>
      <div class="svc-search-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><circle cx="11" cy="11" r="7"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        <input id="svcSearchInput" type="text" autocomplete="off" placeholder="Search services" aria-label="Search services">
      </div>
    </div>

    <section class="svc-dashboard" id="svcAllServicesList">

      
      <div class="svc-category">
        <div class="svc-cat-head" style="--svc-accent:#6656A3;">
          <i class="bi bi-person-badge"></i>
          <span class="svc-cat-title">Human Resource</span>
        </div>
        <div class="svc-grid">

          <div class="svc-card" type="button" data-bs-toggle="modal" data-bs-target="#ssmModal" style="--svc-accent:#6656A3;--svc-tint:#EFEBF8;">
            <div class="svc-card-icon"><i class="bi bi-briefcase"></i></div>
            <div class="svc-card-title">My SSM</div>
            <div class="svc-card-sub">Human Resource System</div>
            <div class="svc-card-desc">Manage and activate SSM accounts, update personal information and documents, and submit enquiries related to SSM services.</div>
            <span class="svc-cta">View options</span>
          </div>
          <!-- My SSM Modal -->
          <div class="modal fade" id="ssmModal" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">My SSM</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <a href="<?php echo e(route('ssms.ssm.index')); ?>">
                    <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                      <div class="card-body" style="padding: 10px;">
                            <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-briefcase"></i>
                              </div>
                              <div class="ps-3">
                                <h6 style="font-size: 22px;">Activate SSM Account</h6>
                              </div>
                            </div>
                      </div>
                    </div>
                  </a>

                  <a href="https://mesh.moe.gov.bn/borangaduanssm">
                    <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                        <div class="card-body" style="padding: 10px;">
                              <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                  <i class="bi bi-chat-right-dots-fill"></i>
                                </div>
                                <div class="ps-3">
                                  <h6 style="font-size: 22px;">SSM Enquiries</h6>
                                </div>
                              </div>
                        </div>
                      </div>
                  </a>
                      <!-- Cuti - Non-clickable, Coming Soon -->
                      <div class="card info-card sales-card coming-soon-card" style="padding: 0px; border: 1px solid grey; margin-bottom: 20px; opacity: 0.6; cursor: not-allowed; position: relative;">
                      <div class="card-body" style="padding: 10px;">
                        <div class="d-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-calendar-week"></i>
                          </div>
                          <div class="ps-3">
                            <h6 style="font-size: 22px;">Leave</h6>
                            <span>Coming Soon</span>
                          </div>
                        </div>
                      </div>
                      <span class="custom-tooltip">Coming soon!</span>
                    </div>

                    <!-- Memangku - Non-clickable, Coming Soon -->
                    <div class="card info-card sales-card coming-soon-card" style="padding: 0px; border: 1px solid grey; margin-bottom: 20px; opacity: 0.6; cursor: not-allowed; position: relative;">
                      <div class="card-body" style="padding: 10px;">
                        <div class="d-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-diagram-2"></i>
                          </div>
                          <div class="ps-3">
                            <h6 style="font-size: 22px;">Acting</h6>
                            <span>Coming Soon</span>
                          </div>
                        </div>
                      </div>
                      <span class="custom-tooltip">Coming soon!</span>
                    </div>

                    <!-- Bersara - Non-clickable, Coming Soon -->
                    <div class="card info-card sales-card coming-soon-card" style="padding: 0px; border: 1px solid grey; margin-bottom: 20px; opacity: 0.6; cursor: not-allowed; position: relative;">
                      <div class="card-body" style="padding: 10px;">
                        <div class="d-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-calendar-event"></i>
                          </div>
                          <div class="ps-3">
                            <h6 style="font-size: 22px;">Retirement</h6>
                            <span>Coming Soon</span>
                          </div>
                        </div>
                      </div>
                      <span class="custom-tooltip">Coming soon!</span>
                    </div>

                </div>
              </div>
            </div>
          </div><!-- End My SSM Modal-->

        </div>
      </div>

      
      <div class="svc-category">
        <div class="svc-cat-head" style="--svc-accent:#1F7A8C;">
          <i class="bi bi-megaphone"></i>
          <span class="svc-cat-title">Communication & Notifications</span>
        </div>
        <div class="svc-grid">

          <?php if(Auth::check() && (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_ONS_USER'))): ?>
            <a class="svc-card" href="<?php echo e(route('onlinenotifications.onlinenotification.indexuser')); ?>" style="--svc-accent:#1F7A8C;--svc-tint:#E7F4F5;">
              <div class="svc-card-icon"><i class="bi bi-phone-vibrate"></i></div>
              <div class="svc-card-title">MNS</div>
              <div class="svc-card-sub">MESH Notification Service</div>
              <div class="svc-card-desc">Broadcast official messages and documents to multiple recipients simultaneously via WhatsApp using the WhatsApp API.</div>
              <span class="svc-cta">Open</span>
            </a>
          <?php else: ?>
            <div class="svc-card svc-card--disabled" style="--svc-accent:#1F7A8C;--svc-tint:#E7F4F5;">
              <div class="svc-card-icon"><i class="bi bi-phone-vibrate"></i></div>
              <div class="svc-card-title">MNS</div>
              <div class="svc-card-sub">MESH Notification Service</div>
              <div class="svc-card-desc">Broadcast official messages and documents to multiple recipients simultaneously via WhatsApp using the WhatsApp API.</div>
              <span class="svc-cta">Open</span>
              <span class="svc-card-tooltip">Access required</span>
            </div>
          <?php endif; ?>

          <a class="svc-card" href="<?php echo e(route('linkup.index')); ?>" style="--svc-accent:#1F7A8C;--svc-tint:#E7F4F5;">
            <div class="svc-card-icon"><i class="bi bi-link-45deg"></i></div>
            <div class="svc-card-title">MLS</div>
            <div class="svc-card-sub">MESH Link Sharing</div>
            <div class="svc-card-desc">Generate shortened links and QR codes for easy sharing and reference.</div>
            <span class="svc-cta">Open</span>
          </a>
          
          
          <a class="svc-card" href="<?php echo e(route('fsm.fsm.index')); ?>" style="--svc-accent:#1F7A8C;--svc-tint:#E7F4F5;">
            <div class="svc-card-icon"><i class="bi bi-link-45deg"></i></div>
            <div class="svc-card-title">FSD</div>
            <div class="svc-card-sub">File Sharing Drive</div>
            <div class="svc-card-desc">Upload, organize and share files and folders.</div>
            <span class="svc-cta">Open</span>
          </a>
          

        </div>
      </div>

      
      <div class="svc-category">
        <div class="svc-cat-head" style="--svc-accent:#B9762E;">
          <i class="bi bi-calendar-check"></i>
          <span class="svc-cat-title">Attendance & Events</span>
        </div>
        <div class="svc-grid">

          <a class="svc-card" href="https://mesh.moe.gov.bn/moeevent" style="--svc-accent:#B9762E;--svc-tint:#F8EEE1;">
            <div class="svc-card-icon"><i class="bi bi-calendar-event-fill"></i></div>
            <div class="svc-card-title">MEA</div>
            <div class="svc-card-sub">MESH Event Attendance</div>
            <div class="svc-card-desc">Manage attendance for Ministry activities, including participant check-in and attendance records for meetings, discussions, training sessions, and other official activities.</div>
            <span class="svc-cta">Open</span>
          </a>

          <a class="svc-card" href="<?php echo e(route('slipkehadiran')); ?>" style="--svc-accent:#B9762E;--svc-tint:#F8EEE1;">
            <div class="svc-card-icon"><i class="bi bi-people-fill"></i></div>
            <div class="svc-card-title">MAS</div>
            <div class="svc-card-sub">MESH Attendance Slip</div>
            <div class="svc-card-desc">Attendance slips for Ministry events and training sessions.</div>
            <span class="svc-cta">Open</span>
          </a>

          <a class="svc-card" href="https://mesh.moe.gov.bn/Q&A" style="--svc-accent:#B9762E;--svc-tint:#F8EEE1;">
            <div class="svc-card-icon"><i class="bi bi-file-text"></i></div>
            <div class="svc-card-title">Q&A</div>
            <div class="svc-card-sub">Q&A Service</div>
            <div class="svc-card-desc">Submit questions anonymously for training or event purposes.</div>
            <span class="svc-cta">Open</span>
          </a>

        </div>
      </div>

      
      <div class="svc-category">
        <div class="svc-cat-head" style="--svc-accent:#3B7A55;">
          <i class="bi bi-mortarboard"></i>
          <span class="svc-cat-title">Operations</span>
        </div>
        <div class="svc-grid">

          <a class="svc-card" href="<?php echo e(route('cddinventory.cddinventory.index')); ?>" style="--svc-accent:#3B7A55;--svc-tint:#E9F3EC;">
            <div class="svc-card-icon"><i class="bi bi-bookmark-star-fill"></i></div>
            <div class="svc-card-title">CMS</div>
            <div class="svc-card-sub">Curriculum Materials Service</div>
            <div class="svc-card-desc">Manage applications and services related to curriculum materials.</div>
            <span class="svc-cta">Open</span>
          </a>

          <a class="svc-card" href="<?php echo e(route('cca.cca.index')); ?>" style="--svc-accent:#3B7A55;--svc-tint:#E9F3EC;">
            <div class="svc-card-icon"><i class="bi bi-trophy"></i></div>
            <div class="svc-card-title">CCAM</div>
            <div class="svc-card-sub">Co-Curriculum Activities Management</div>
            <div class="svc-card-desc">Manage and coordinate co-curricular activities.</div>
            <span class="svc-cta">Open</span>
          </a>

          <div class="svc-card" type="button" data-bs-toggle="modal" data-bs-target="#emaModal" style="--svc-accent:#3B7A55;--svc-tint:#E9F3EC;">
            <?php if(($totalEmemoTindakan ?? 0) > 0): ?>
              <span class="home-svc-badge" title="D Flow waiting for your action"><?php echo e($totalEmemoTindakan); ?> to act</span>
            <?php endif; ?>
            <div class="svc-card-icon"><i class="bi bi-envelope-paper"></i></div>
            <div class="svc-card-title">
              D Flow
              <?php if(Auth::check() && (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_EMINITADMIN'))): ?>
              <span class="badge rounded-pill" style="background-color:#1F4E78; color:#fff; font-size:11px; padding:3px 9px; vertical-align:middle;">
                <i class="bi bi-shield-lock-fill me-1"></i>Admin
              </span>
              <?php endif; ?>
            </div>
            <div class="svc-card-sub">Documentation Flow</div>
            <div class="svc-card-desc">Create, track, and action official e-memos routed to your department.</div>
            <span class="svc-cta">View options</span>
          </div>
          <!-- EMA Modal -->
          <div class="modal fade" id="emaModal" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">D Flow Action</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <?php if(Auth::check() && (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_EMINITADMIN'))): ?>
                  <div class="card info-card sales-card" style="padding:0; border:1px solid blue; margin-bottom:20px; cursor:pointer;" onclick="window.location.href='<?php echo e(route('eminit.eminit.indexeminitadmin')); ?>'">
                    <div class="card-body" style="padding:10px;">
                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-card-heading"></i>
                        </div>
                        <div class="ps-3">
                          <h6 style="font-size:22px;">List of D Flow</h6>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card info-card sales-card" style="padding:0; border:1px solid #1F4E78; border-left:4px solid #012970; margin-bottom:20px; background-color:#EAF1FB;" onclick="window.location.href='<?php echo e(route('eminit.eminit.indexeminit')); ?>'">
                    <div class="card-body" style="padding:10px;">
                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-journal-text"></i>
                        </div>
                        <div class="ps-3">
                          <h6 style="font-size:22px;">Create D Flow</h6>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card info-card sales-card" style="padding:0; border:1px solid #1F4E78; border-left:4px solid #012970; margin-bottom:20px; background-color:#EAF1FB;" onclick="window.location.href='<?php echo e(route('eminit.eminit.indexeminitaction')); ?>'">
                    <div class="card-body" style="padding:10px;">
                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="ps-3">
                          <div style="display:flex; align-items:center; gap:10px;">
                            <h6 style="font-size:22px; margin:0;">D Flow (Action)</h6>
                            <h6 style="
                                font-size:26px;
                                display:inline-block;
                                background-color:#FFD700;
                                color:white;
                                width:50px;
                                height:50px;
                                line-height:50px;
                                text-align:center;
                                border-radius:50%;
                                font-weight:bold;
                                margin:0;
                            ">
                              <?php echo e($totalEmemoTindakan ?? 0); ?>

                            </h6>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card info-card sales-card" style="padding:0; border:1px solid blue; margin-bottom:20px; cursor:pointer;" onclick="window.location.href='<?php echo e(route('adminsettings.adminsettingsdashboard')); ?>'">
                    <div class="card-body" style="padding:10px;">
                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-gear-fill"></i>
                        </div>
                        <div class="ps-3">
                          <h6 style="font-size:22px;">Settings</h6>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php else: ?>
                  <?php if(Auth::check() && Auth::user()->hasRole('ROLE_CREATE_EMEMO')): ?>
                  <div class="card info-card sales-card" style="padding:0; border:1px solid blue; margin-bottom:20px; cursor:pointer;" onclick="window.location.href='<?php echo e(route('eminit.eminit.indexeminit')); ?>'">
                    <div class="card-body" style="padding:10px;">
                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-journal-text"></i>
                        </div>
                        <div class="ps-3">
                          <h6 style="font-size:22px;">Create D Flow</h6>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php endif; ?>
                  <div class="card info-card sales-card" style="padding:0; border:1px solid blue; margin-bottom:20px; cursor:pointer;" onclick="window.location.href='<?php echo e(route('eminit.eminit.indexeminitaction')); ?>'">
                    <div class="card-body" style="padding:10px;">
                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="ps-3">
                          <h6 style="font-size:22px;">D Flow Action</h6>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div><!-- End EMA Modal -->

          <!-- Deep-link support: ?open=EMT opens the EMA modal directly -->
          <script>
          document.addEventListener('DOMContentLoaded', function () {
              const params = new URLSearchParams(window.location.search);
              const open = params.get('open');

              if (open === 'EMT') {
                  const modalElement = document.getElementById('emaModal');
                  const modal = new bootstrap.Modal(modalElement);
                  modal.show();
              }
          });
          </script>

        </div>
      </div>

      
      <div class="svc-category">
        <div class="svc-cat-head" style="--svc-accent:#A24638;">
          <i class="bi bi-tools"></i>
          <span class="svc-cat-title">Facilities & Support</span>
        </div>
        <div class="svc-grid">

          <div class="svc-card" type="button" onclick="openFasilitasMain()" style="--svc-accent:#A24638;--svc-tint:#F7E9E6;">
            <div class="svc-card-icon"><i class="bi bi-door-open"></i></div>
            <div class="svc-card-title">Facility Booking Management</div>
            <div class="svc-card-desc">Reserve meeting and syndicate rooms within the Ministry of Education for internal meetings and activities.</div>
            <span class="svc-cta">View options</span>
          </div>

          <!-- MODAL -->
          <div class="modal fade" id="fasilitasModal" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <h5 class="modal-title" id="fasilitasTitle">
                  Facility Booking Management
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <div class="modal-body" id="fasilitasBody">
                <!-- Dynamic -->
              </div>

            </div>
          </div>
          </div>

          <!-- SCRIPT -->
          <script>
          function openFasilitasMain() {

          document.getElementById('fasilitasTitle').innerText =
            'Facility Booking Management';

          document.getElementById('fasilitasBody').innerHTML = `
            <div class="card info-card sales-card mb-3"
                 style="padding:0; border:1px solid blue; cursor:pointer;"
                 onclick="openTBM()">
              <div class="card-body" style="padding:10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-door-open"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size:22px;">MRB</h6>
                    <span>Meeting Room Booking</span>
                  </div>
                </div>
              </div>
            </div>

            <a href="<?php echo e(route('bookings.booking.home')); ?>" style="text-decoration:none;">
              <div class="card info-card sales-card"
                   style="padding:0; border:1px solid blue;">
                <div class="card-body" style="padding:10px;">
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-door-closed"></i>
                    </div>
                    <div class="ps-3">
                      <h6 style="font-size:22px;">SRB</h6>
                      <span>Syndicate Room Booking</span>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          `;

          new bootstrap.Modal(document.getElementById('fasilitasModal')).show();
          }

          function openTBM() {

          document.getElementById('fasilitasTitle').innerText =
            'MRB - Meeting Room Booking';

          document.getElementById('fasilitasBody').innerHTML = `
            <a href="<?php echo e(route('adminbooking.searchroomadmin')); ?>" style="text-decoration:none;">
              ${fasilitasItem('bi-search','Search Room Availability')}
            </a>

            <a href="<?php echo e(route('adminbooking.systemcalendaradmin')); ?>" style="text-decoration:none;">
              ${fasilitasItem('bi-calendar','Calendar')}
            </a>

            <a href="<?php echo e(route('adminbooking.booking.indexadmin')); ?>" style="text-decoration:none;">
              ${fasilitasItem('bi-calendar-check','Booking')}
            </a>

            <a href="<?php echo e(route('adminbooking.rooms.index')); ?>" style="text-decoration:none;">
              ${fasilitasItem('bi-door-open','Room')}
            </a>

            <button class="btn btn-secondary mt-2" onclick="openFasilitasMain()">
              Back
            </button>
          `;
          }

          function fasilitasItem(icon, text) {
          return `
            <div class="card info-card sales-card mb-3"
                 style="padding:0; border:1px solid blue;">
              <div class="card-body" style="padding:10px;">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi ${icon}"></i>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size:18px;">${text}</h6>
                  </div>
                </div>
              </div>
            </div>
          `;
          }
          </script>

          <div class="svc-card" type="button" data-bs-toggle="modal" data-bs-target="#permohonanModal" style="--svc-accent:#A24638;--svc-tint:#F7E9E6;">
            <div class="svc-card-icon"><i class="bi bi-file-code"></i></div>
            <div class="svc-card-title">Support Request</div>
            <div class="svc-card-desc">Get technical support and assistance from the DevOps Support Desk.</div>
            <span class="svc-cta">View options</span>
          </div>
          <!-- Permohonan Sokongan Modal -->
          <div class="modal fade" id="permohonanModal" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Support Request</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <!-- DSD - DevOps Service Desk -->
                <a href="https://mesh.moe.gov.bn/dsd">
                    <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                        <div class="card-body" style="padding: 10px;">
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-headset"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 style="font-size: 22px;">DSS</h6>
                                    <span>DevOps Support Service</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                  <!-- DRF - DevOps Request Form -->
                  <a href="https://mesh.moe.gov.bn/drf">
                    <div class="card info-card sales-card" style="padding: 0px; border: 1px solid blue; margin-bottom: 20px;">
                      <div class="card-body" style="padding: 10px;">
                            <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-gear-wide-connected"></i>
                              </div>
                              <div class="ps-3">
                                <h6 style="font-size: 22px;">DRF</h6>
                                <span>DevOps Request Form</span>
                              </div>
                            </div>
                      </div>
                    </div>
                  </a>

                </div>
              </div>
            </div>
          </div><!-- End Permohonan Sokongan Modal-->

          <!--Permohonan Peranan Akses -->
          <a class="svc-card" href="https://mesh.moe.gov.bn/borangpermohonanperanan" style="--svc-accent:#A24638;--svc-tint:#F7E9E6;">
            <div class="svc-card-icon"><i class="bi bi-person-square"></i></div>
            <div class="svc-card-title">Role Access</div>
            <div class="svc-card-desc">Request or review the MESH roles and permission levels assigned to your account.</div>
            <span class="svc-cta">Open</span>
          </a>

        </div>
      </div>

    </section>

    <script>
    // Services search — same behaviour as servicesdashboard.blade.php
    (function(){
      var cats = Array.from(document.querySelectorAll('#svcAllServicesList .svc-category'));
      var input = document.getElementById('svcSearchInput');
      if (input) {
        input.addEventListener('input', function(){
          var q = input.value.trim().toUpperCase();
          cats.forEach(function(cat){
            var any = false;
            Array.from(cat.querySelectorAll('.svc-card')).forEach(function(card){
              var match = !q || card.innerText.toUpperCase().includes(q);
              card.hidden = !match;
              if (match) any = true;
            });
            cat.hidden = !any;
          });
        });
      }
    })();

    </script>
<?php /**PATH S:\MOE USER\Documents\Mesh110626-Combined\resources\views/inc/home-services.blade.php ENDPATH**/ ?>