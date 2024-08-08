document.addEventListener('DOMContentLoaded', function () {
    const OTP_EXPIRE_TIME = 2 * 60 * 1000; // 2 minutes in milliseconds
    const TIMER_KEY = 'otpExpireTime';
    const timerElement = document.getElementById('timer');
    const resendOtpBtn = document.getElementById('resend-otp-btn');

    function startTimer(expireTime) {
        const interval = setInterval(() => {
            const currentTime = new Date().getTime();
            const remainingTime = expireTime - currentTime;

            if (remainingTime <= 0) {
                clearInterval(interval);
                timerElement.textContent = 'Kode OTP telah kedaluwarsa. Silakan lakukan permintaan OTP baru.';
                resendOtpBtn.disabled = false;
                localStorage.removeItem(TIMER_KEY);
                return;
            }

            let minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);
            seconds = seconds < 10 ? '0' + seconds : seconds;

            timerElement.textContent = `Kode OTP akan berakhir dalam: ${minutes}:${seconds}`;
        }, 1000);
    }

    function setExpireTime() {
        const expireTime = new Date().getTime() + OTP_EXPIRE_TIME;
        localStorage.setItem(TIMER_KEY, expireTime);
        return expireTime;
    }

    let expireTime = localStorage.getItem(TIMER_KEY);
    if (!expireTime) {
        expireTime = setExpireTime();
    }
    startTimer(expireTime);
});
