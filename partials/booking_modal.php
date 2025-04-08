<div class="modal fade" id="reserveModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">예약 폼</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <form action="/api/reserve" method="POST">
      <div class="modal-body">
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" id="radioPractice" autocomplete="off" checked="" value="0">
            <label class="btn btn-outline-primary" for="radioPractice">합주</label>
            <input type="radio" class="btn-check" id="radioMentoring" autocomplete="off" value="1">
            <label class="btn btn-outline-primary disabled" for="radioMentoring">멘토링</label>
        </div>
        <div class="d-none"><input name="date" class="form-control" id="selectedDate" type="text" value="<?= $date->format("Y-m-d") ?>"></div>
          <div>
              <fieldset>
                  <label class="form-label mt-4 practice" for="selectedTime">합주 시간</label>
                  <label class="form-label mt-4 mentoring" for="selectedTime">멘토링 시간</label>
                  <input name="time" class="form-control" id="selectedTime" type="text" placeholder="" readonly="">
              </fieldset>
          </div>
          <div>
              <label class="col-form-label mt-4 practice" for="reserveName">팀 명 (곡 명)</label>
              <label class="col-form-label mt-4 mentoring" for="reserveName">수업 이름 (악기)</label>
              <input name="reserveName" type="text" class="form-control" id="reserveName">
              <div class="invalid-feedback">값을 입력해주세요.</div>
          </div>
          <div>
              <label class="col-form-label mt-4 practice" for="applicantName">신청자 이름</label>
              <label class="col-form-label mt-4 mentoring" for="applicantName">멘토 이름</label>
              <input name="userName" type="text" class="form-control" id="applicantName">
              <div class="invalid-feedback">값을 입력해주세요.</div>
          </div>
          <div class="mentoring">
              <label for="repeatWeeks" class="form-label mt-4">멘토링 기간</label>
              <input type="number" class="form-control" id="repeatWeeks" min="1" max="12" value="1">
              <small class="form-text text-muted">입력한 주 수 만큼 매주 예약됩니다.</small>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary disabled" id="reserveBtn">예약하기</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
    // 멘토링 관련 요소는 안보이게 초기 설정
    const repeatWeeks = document.getElementById('repeatWeeks');

    document.querySelectorAll('.mentoring').forEach(el => {
        el.classList.add('d-none');
    });
</script>