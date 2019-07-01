<?php if(!empty($quiz_results) && !$empty) { ?>
    <div class="edgt-quiz-retakes">
        <div class="edgt-results-caption">
            <?php echo esc_html__('Other results', 'edge-lms'); ?>
        </div>
        <table>
            <thead>
                <tr>
                    <th>
                        <?php echo esc_html__('#', 'edge-lms'); ?>
                    </th>
                    <th>
                        <?php echo esc_html__('Date', 'edge-lms'); ?>
                    </th>
                    <th>
                        <?php echo esc_html__('Time', 'edge-lms'); ?>
                    </th>
                    <th>
                        <?php echo esc_html__('Result', 'edge-lms'); ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($quiz_results as $key => $quiz_result) { ?>
                    <?php if($quiz_result['status'] == 'completed') { ?>
                        <tr>
                            <td>
                                <?php echo esc_html($key + 1); ?>
                            </td>
                            <td>
                                <?php echo esc_html($quiz_result['timestamp']); ?>
                            </td>
                            <td>
                                <?php echo esc_html($quiz_result['time']); ?>
                            </td>
                            <td>
                                <?php echo esc_html($quiz_result['result']) . '%'; ?>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php }