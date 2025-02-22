<form action="admin/order/changestatus" method="post">
    <!-- Input ẩn chứa Order ID -->
    <input type="number" value="<?= htmlspecialchars($order_id) ?>" name="order_id" hidden>

    <!-- Dropdown chọn trạng thái -->
    <div class="mb-3">
        <select class="form-select" name="order_status" required>
            <?php foreach ($statusOption as $option): ?>
                <option value="<?= htmlspecialchars($option) ?>" <?= ($current_status == $option) ? 'selected' : '' ?>>
                    <?= ucfirst(htmlspecialchars($option)) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Nút điều khiển -->
    <div class="col text-end">
        <button type="button" class="danger-btn" data-bs-dismiss="modal" aria-label="Close">
            Cancel
        </button>
        <button type="submit" class="success-btn">
            <i class="bi bi-file-earmark-text"></i> Save
        </button>
    </div>
</form>