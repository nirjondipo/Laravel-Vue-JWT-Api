import axios from 'axios';
import { ref } from 'vue';

const isLoggedIn = ref(!!localStorage.getItem('token'));

export function getAuthStatus() {
  return isLoggedIn;
}

export async function sendOtp(email) {
    try {
        await axios.post('/api/auth/send-otp', { email });
    } catch (error) {
        throw error;
    }
}

export async function verifyOtp(email, otp) {
  try {
    const response = await axios.post('/api/auth/verify-otp', { email, otp });
    return response.data; // Assuming server returns necessary data
  } catch (error) {
    throw error;
  }
}

export async function login(token) {
  localStorage.setItem('token', token);
  isLoggedIn.value = true;
}

export function logout() {
  localStorage.removeItem('token');
  isLoggedIn.value = false;
}

export function getToken() {
  return localStorage.getItem('token');
}

export async function refreshToken() {
  try {
    const response = await axios.post('/api/refresh');
    const { access_token } = response.data;
    localStorage.setItem('token', access_token);
    isLoggedIn.value = true;
    return access_token;
  } catch (error) {
    console.error('Error refreshing token:', error);
    throw error;
  }
}
