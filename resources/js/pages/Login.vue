<template>

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
          <div class="authentication-inner py-4">
            <!-- Login -->
            <div class="card">
              <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center mb-4 mt-2">
                  <router-link to="/" class="app-brand-link gap-2">
                    <span class="app-brand-logo demo">
                      <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                          fill="#7367F0" />
                        <path
                          opacity="0.06"
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                          fill="#161616" />
                        <path
                          opacity="0.06"
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                          fill="#161616" />
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                          fill="#7367F0" />
                      </svg>
                    </span>
                    <span class="app-brand-text demo text-body fw-bold ms-1">{{ appName }}</span>
                </router-link>
                </div>
                <!-- /Logo -->
                 <div v-if="!showOtpVerification">
                    <h4 class="mb-1 pt-2">Welcome to {{ appName }}! 👋</h4>
                    <p class="mb-4">Please sign-in to your account and start the adventure</p>
                    <form @submit.prevent="login">
                      <div class="mb-3">
                        <label for="email" class="form-label">Email or Username</label>
                        <input
                          type="text"
                          class="form-control"
                          id="email"
                          v-model="email"
                          name="email-username"
                          placeholder="Enter your email or username"
                          autofocus @input="clearMessage"/>
                          <p class="text-danger w-100 mt-2" v-if="errors.email">{{ errors.email }}</p>
                      </div>
                      <div class="mb-3 form-password-toggle">
                        <div class="d-flex justify-content-between">
                          <label class="form-label" for="password">Password</label>
                          <a href="auth-forgot-password-basic.html">
                            <small>Forgot Password?</small>
                          </a>
                        </div>
                        <div class="input-group input-group-merge">
                            <input
                            :type="passwordVisible ? 'text' : 'password'"
                            id="password"
                            v-model="password"
                            class="form-control"
                            name="password"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="password"
                            @input="clearMessage"/>
                          <span class="input-group-text cursor-pointer" @click="togglePasswordVisibility">
                            <i :class="['ti', passwordVisible ? 'ti-eye' : 'ti-eye-off']"></i>
                          </span>
                          <p class="text-danger w-100 mt-2" v-if="errors.password">{{ errors.password }}</p>
                        </div>
                      </div>
                      <div class="mb-3">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="remember-me" />
                          <label class="form-check-label" for="remember-me"> Remember Me </label>
                        </div>
                      </div>
                      <div class="mb-3">
                        <button class="btn btn-primary d-grid w-100" type="submit" :disabled="loading" v-if="!loading">Sign in</button>
                        <div class="demo-inline-spacing" v-if="loading">
                            <button class="btn btn-primary d-flex w-100" type="button" disabled>
                                <span class="spinner-border me-1" role="status" aria-hidden="true"></span>
                                Sending...
                            </button>
                        </div>
                      </div>
                    </form>
                 </div>
                <div v-if="showOtpVerification">
                    <h4 class="mb-1 pt-2">Two Step Verification 💬</h4>
                    <p class="text-start mb-4">
                      We sent a verification code to your email. Enter the code from the email in the field below.
                      <span class="fw-medium d-block mt-2">******1234</span>
                    </p>
                    <p class="mb-0 fw-medium">Type your 6 digit security code</p>
                    <form id="twoStepsForm">
                        <div class="mb-3">
                        <div class="auth-input-wrapper d-flex align-items-center justify-content-sm-between numeral-mask-wrapper">
                            <input
                            type="tel"
                            class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2"
                            maxlength="1"
                            autofocus
                            v-model="otpDigits[0]"
                            @input="clearMessage"
                            />
                            <input
                            type="tel"
                            class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2"
                            maxlength="1"
                            v-model="otpDigits[1]"
                            @input="clearMessage"
                            />
                            <input
                            type="tel"
                            class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2"
                            maxlength="1"
                            v-model="otpDigits[2]"
                            @input="clearMessage"
                            />
                            <input
                            type="tel"
                            class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2"
                            maxlength="1"
                            v-model="otpDigits[3]"
                            @input="clearMessage"
                            />
                            <input
                            type="tel"
                            class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2"
                            maxlength="1"
                            v-model="otpDigits[4]"
                            @input="clearMessage"
                            />
                            <input
                            type="tel"
                            class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2"
                            maxlength="1"
                            v-model="otpDigits[5]"
                            @input="clearMessage"
                            />
                        </div>
                        <!-- Create a hidden field which is combined by 6 fields above -->
                        <input type="hidden" name="otp" v-model="otp" />
                        </div>
                        <p v-if="otpError">{{ otpError }}</p>
                        <button class="btn btn-primary d-grid w-100 mb-3" @click.prevent="verifyOtp" :disabled="otpLoading">
                        Verify my account
                        </button>
                        <div v-if="resendTimeout > 0">
                            <p>Resend OTP in {{ resendTimeout }} seconds</p>
                          </div>
                        <div class="text-center" v-if="resendTimeout <= 0">
                        Didn't get the code?
                        <a href="javascript:void(0);" @click="resendOtp"> Resend </a>
                        </div>
                    </form>
                </div>
              </div>
            </div>
            <!-- /Register -->
          </div>
        </div>
    </div>
  </template>
  <script>
  import { login, sendOtp, verifyOtp } from '../auth'; // Import login and OTP functions
  import { toast } from '../toastify'; // Adjust path as per your project structure
  import { mapState } from 'vuex';

  export default {
    computed: {
      ...mapState(['appName']),
    },
    data() {
      return {
        email: '',
        password: '',
        errors: {
          email: '',
          password: '',
          // Add more fields as needed
        },
        loading: false,
        showOtpVerification: false,
        otp: '',
        otpError: '',
        resendTimeout: 0,
        otpLoading: false, // Loading state for OTP verification
        passwordVisible: false, // Track password visibility
        otpDigits: ['', '', '', '', '', ''], // Array to store individual OTP digits
      };
    },
    watch: {
      showOtpVerification(newValue) {
        if (newValue) {
          this.$nextTick(() => {
            this.initializeNumeralMask();
          });
        }
      },
    },
    methods: {
      async login() {
        this.loading = true;
        try {
          const response = await this.$axios.post('/api/auth/login', {
            email: this.email,
            password: this.password,
            otp: this.otp, // Include otp in the login request if entered
          });

          // Check if email verification is required
          if (response.data.requiresVerification) {
            // Set flag to show OTP verification section
            this.showOtpVerification = true;
            // Send OTP to user's email
            await sendOtp(this.email);
            this.startResendTimer(); // Start countdown timer for OTP resend
          } else {
            // Directly log in user if verification is not required
            login(response.data.access_token);
            this.$router.push({ name: 'home' });
          }
        } catch (error) {
          if (error.response) {
            const { errors, message } = error.response.data;
            if (errors) {
              // Handle field-specific errors
              if (errors.email) {
                this.errors.email = errors.email[0]; // Assuming server sends email errors as an array
                toast.error(this.errors.email);
              }
              if (errors.password) {
                this.errors.password = errors.password[0]; // Assuming server sends password errors as an array
                toast.error(this.errors.password);
              }
            } else {
              // Handle general error
              this.errors.email = '';
              this.errors.password = '';
              toast.error(message || 'An error occurred');
            }
          } else {
            // Handle other types of errors
            toast.error('An error occurred');
          }
        } finally {
          this.loading = false;
        }
      },
      async verifyOtp() {
        this.otp = this.otpDigits.join(''); // Combine individual OTP digits into a single string
        if (this.otp.length !== 6) {
          this.otpError = 'Please enter a valid OTP.';
          return;
        }
        this.otpLoading = true;
        try {
          await verifyOtp(this.email, this.otp);
          // Once OTP is verified, proceed to login
          const response = await this.$axios.post('/api/auth/login', {
            email: this.email,
            password: this.password,
          });
          login(response.data.access_token);
          this.$router.push({ name: 'home' });
        } catch (error) {
          this.otpError = error.response ? error.response.data.error : 'An error occurred';
        } finally {
          this.otpLoading = false;
        }
      },
      clearMessage() {
        this.errors.email = '';
        this.errors.password = '';
        this.otpError = '';
      },
      async resendOtp() {
        if (this.resendTimeout <= 0) {
          try {
            await sendOtp(this.email);
            this.startResendTimer();
          } catch (error) {
            console.error('Error resending OTP:', error);
            // Handle error if necessary
          }
        }
      },
      startResendTimer() {
        this.resendTimeout = 60;
        const timer = setInterval(() => {
          this.resendTimeout--;
          if (this.resendTimeout <= 0) {
            clearInterval(timer);
          }
        }, 1000);
      },
      togglePasswordVisibility() {
        this.passwordVisible = !this.passwordVisible;
      },
      initializeNumeralMask() {
        const maskWrapper = this.$el.querySelector('.numeral-mask-wrapper');
        if (!maskWrapper) return;

        const numeralMasks = maskWrapper.querySelectorAll('.numeral-mask');

        for (let pin of numeralMasks) {
          pin.onkeyup = (e) => {
            // Check if the key pressed is a number (0-9)
            if (/^\d$/.test(e.key)) {
              // While entering value, go to next
              if (pin.nextElementSibling) {
                if (pin.value.length === parseInt(pin.attributes['maxlength'].value)) {
                  pin.nextElementSibling.focus();
                }
              }
            } else if (e.key === 'Backspace') {
              // While deleting entered value, go to previous
              if (pin.previousElementSibling) {
                pin.previousElementSibling.focus();
              }
            }
          };
          // Prevent the default behavior for the minus key
          pin.onkeypress = (e) => {
            if (e.key === '-') {
              e.preventDefault();
            }
          };
        }

        maskWrapper.addEventListener('paste', (e) => {
          e.preventDefault();
          const pasteData = e.clipboardData.getData('text');
          if (/^\d{6}$/.test(pasteData)) {
            pasteData.split('').forEach((char, index) => {
              this.otpDigits[index] = char;
            });
            this.updateOtpField();
          }
        });
      },
      updateOtpField() {
        this.otp = this.otpDigits.join('');
      },
    },
  };
  </script>

<style scoped>
  /* Add scoped styles here */
</style>
