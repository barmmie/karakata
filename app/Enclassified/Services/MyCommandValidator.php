<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/19/15
 * Time: 10:34 PM
 */

namespace Enclassified\Services;

use Enclassified\Exceptions\ValidationFailedException;
class MyCommandValidator {
    /**
     * Validate a command
     *
     * @param Command $command
     * @return bool
     * @throws \Enclassified\Exceptions\ValidationFailedException
     */
    public function validate($command)
    {
        if(method_exists($command, 'rules')) {

            $rules = $command->rules();

            if(!empty($rules)) {
                $validator = \Validator::make((array) $command, $rules);

                if($validator->fails()) {
                    throw new ValidationFailedException('Form validation failed', $validator->getMessageBag());
                }
            }
        }

        return true;
    }
}