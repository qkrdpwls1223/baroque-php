const reserveName = document.getElementById('reserveName');
const userName = document.getElementById('applicantName');
const reserveBtn = document.getElementById('reserveBtn');

// 입력 값 제어 (빈칸이면 feedback 표시, 예약 버튼 비활성화)
function handleFormValidation(e) {
  e.target.classList.toggle('is-invalid', e.target.value.trim() === "");

  const isReserveValid = reserveName.value.trim() === "";
  const isUserValid = userName.value.trim() === "";

  reserveBtn.classList.toggle('disabled', isReserveValid || isUserValid);
}

reserveName.addEventListener('input', handleFormValidation);
userName.addEventListener('input', handleFormValidation);


// 부트스트랩 이벤트로 예약 모달이 뜰 때 시간값 전달
const reserveModal = document.getElementById('reserveModal');

reserveModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget; // 클릭된 시간 버튼
    const time = button.getAttribute('data-time');

    // 모달 내부 요소에 시간 표시
    document.getElementById('selectedTime').value = time;
});


// 예약 유형에 따른 label 표시
document.querySelectorAll('input[name="formSelecter"]').forEach(radio => {
    radio.addEventListener('change', function () {
        reserveName.value = "";
        userName.value = "";
        reserveBtn.classList.add('disabled');

        document.querySelectorAll('.practice').forEach(el => {
            el.classList.toggle('d-none', Number(this.value));
        });
        document.querySelectorAll('.mentoring').forEach(el => {
            el.classList.toggle('d-none', !Number(this.value));
        });

    });
});


// 부트스트랩 이벤트로 예약 모달이 뜰 때 시간값 전달
const cancelModal = document.getElementById('cancelModal');

cancelModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget; // 클릭된 시간 버튼
    const time = button.getAttribute('data-time');
    const info = button.textContent;

    // 모달 내부 요소에 시간 표시
    document.getElementById('cancelTime').textContent = time;
    document.getElementById('cancelInfo').textContent = info;
    document.getElementById('cancelTimeInput').value = time;
});