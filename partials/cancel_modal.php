<div class="modal fade" id="cancelModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">예약 취소</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <form action="/api/reserve-cancel" method="POST">
      <div class="modal-body">
        <div class="p-2">
        <div class="d-none">
          <input name="date" type="text" value="<?= $date->format("Y-m-d") ?>">
          <input name="time" type="text" id="cancelTimeInput">
        </div>
        <p><strong id="cancelTime"></strong> 에 예약된 <strong id="cancelInfo"></strong> 을(를) 정말로 취소하시겠습니까?</p>
        <small class="text-body-secondary">돌이킬 수 없는 요청입니다. 남의 예약을 취소하지 않도록 조심해주세요.</small>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-secondary" id="reserveCancel">취소하기</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">닫기</button>
      </div>
      </form>
    </div>
  </div>
</div>