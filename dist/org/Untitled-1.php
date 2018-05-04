                <tbody id="checktime-tbody">
                  <?php
                    // foreach($data AS $var) {
                  ?>
                  <tr>
                    <?php
                      // $sql = "SELECT SUM(hours) FROM shift_table WHERE staff_id=" . $var['staff_id'];
                      // $total = $db->getValue($sql);
                    ?>
                      <!-- 姓名 -->
                      <td class="name">
                        <!-- <?php echo $var['name']; ?> -->
                      </td>
                      <!-- 日期 -->
                      <td id = "checktime-td" class = "checktime-td" colspan="31">
                          <div class = "checktime-box d-flex justify-content-around"></div>
                      </td>
                      <!-- 時數 -->
                      <td class="totaltime">
                        <!-- <?php echo $total; ?> -->
                      </td>
                  </tr>
                  <?php
                    // }
                  ?>
                </tbody>
