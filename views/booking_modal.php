<div class="modal fade" id="reserveModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">예약 폼</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" name="formSelecter" id="radioPractice" autocomplete="off" checked="" value="0">
            <label class="btn btn-outline-primary" for="radioPractice">합주</label>
            <input type="radio" class="btn-check" name="formSelecter" id="radioMentoring" autocomplete="off" value="1">
            <label class="btn btn-outline-primary" for="radioMentoring">멘토링</label>
        </div>
            <div>
                <fieldset>
                    <label class="form-label mt-4 practice" for="selectedTime">합주 시간</label>
                    <label class="form-label mt-4 mentoring" for="selectedTime">멘토링 시간</label>
                    <input class="form-control" id="selectedTime" type="text" placeholder="" readonly="">
                </fieldset>
            </div>
            <div>
                <label class="col-form-label mt-4 practice" for="reserveName">팀 명 (곡 명)</label>
                <label class="col-form-label mt-4 mentoring" for="reserveName">수업 이름 (악기)</label>
                <input type="text" class="form-control" id="reserveName">
                <div class="invalid-feedback">값을 입력해주세요.</div>
            </div>
            <div>
                <label class="col-form-label mt-4 practice" for="applicantName">신청자 이름</label>
                <label class="col-form-label mt-4 mentoring" for="applicantName">멘토 이름</label>
                <input type="text" class="form-control" id="applicantName">
                <div class="invalid-feedback">값을 입력해주세요.</div>
            </div>
            <div class="mentoring">
                <label for="repeatWeeks" class="form-label mt-4">멘토링 기간</label>
                <input type="number" class="form-control" id="repeatWeeks" min="1" max="12" value="1">
                <small class="form-text text-muted">입력한 주 수 만큼 매주 예약됩니다.</small>
            </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary disabled" id="btnReserve">예약하기</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
      </div>
    </div>
  </div>
</div>

<script>
    // 모달창에서 입력값 제어 (빈칸 또는 공백을 입력 받지 않게함)
    const reserveName = document.getElementById('reserveName');
    const userName = document.getElementById('applicantName');
    const btnReserve = document.getElementById('btnReserve');

    reserveName.addEventListener('input', function () {
    if (reserveName.value.trim() === "") {
        reserveName.classList.add('is-invalid'); // 경고 메시지 보이기
        btnReserve.classList.add('disabled');
    } else {
        reserveName.classList.remove('is-invalid'); // 경고 메시지 숨기기
        if (userName.value.trim() !== "") {
            btnReserve.classList.remove('disabled');
        }
    }
    });

    userName.addEventListener('input', function () {
    if (userName.value.trim() === "") {
        userName.classList.add('is-invalid'); // 경고 메시지 보이기
        btnReserve.classList.add('disabled');
    } else {
        userName.classList.remove('is-invalid'); // 경고 메시지 숨기기
        if (reserveName.value.trim() !== "") {
            btnReserve.classList.remove('disabled');
        }
    }
    });

    // 부트스트랩 이벤트로 모달이 뜰 때 시간값 전달
    const reserveModal = document.getElementById('reserveModal');

    reserveModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // 클릭된 시간 버튼
        const time = button.getAttribute('data-time');

        // 모달 내부 요소에 시간 표시
        document.getElementById('selectedTime').value = time;
    });


    const repeatWeeks = document.getElementById('repeatWeeks');

    // 멘토링 관련 요소는 안보이게 초기 설정
    document.querySelectorAll('.mentoring').forEach(el => {
        el.classList.add('d-none');
    });

    document.querySelectorAll('input[name="formSelecter"]').forEach(radio => {
        radio.addEventListener('change', function () {
            reserveName.value = "";
            userName.value = "";
            btnReserve.classList.add('disabled');

            if (this.value == 0) {
                document.querySelectorAll('.practice').forEach(el => {
                    el.classList.remove('d-none');
                });
                document.querySelectorAll('.mentoring').forEach(el => {
                    el.classList.add('d-none');
                });
            } else {
                repeatWeeks.value = 1;

                document.querySelectorAll('.mentoring').forEach(el => {
                    el.classList.remove('d-none');
                });
                document.querySelectorAll('.practice').forEach(el => {
                    el.classList.add('d-none');
                });
            }
        });
    });
</script>