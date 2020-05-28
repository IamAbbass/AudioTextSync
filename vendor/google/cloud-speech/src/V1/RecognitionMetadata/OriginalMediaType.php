<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/speech/v1/cloud_speech.proto

namespace Google\Cloud\Speech\V1\RecognitionMetadata;

use UnexpectedValueException;

/**
 * The original media the speech was recorded on.
 *
 * Protobuf type <code>google.cloud.speech.v1.RecognitionMetadata.OriginalMediaType</code>
 */
class OriginalMediaType
{
    /**
     * Unknown original media type.
     *
     * Generated from protobuf enum <code>ORIGINAL_MEDIA_TYPE_UNSPECIFIED = 0;</code>
     */
    const ORIGINAL_MEDIA_TYPE_UNSPECIFIED = 0;
    /**
     * The speech data is an audio recording.
     *
     * Generated from protobuf enum <code>AUDIO = 1;</code>
     */
    const AUDIO = 1;
    /**
     * The speech data originally recorded on a video.
     *
     * Generated from protobuf enum <code>VIDEO = 2;</code>
     */
    const VIDEO = 2;

    private static $valueToName = [
        self::ORIGINAL_MEDIA_TYPE_UNSPECIFIED => 'ORIGINAL_MEDIA_TYPE_UNSPECIFIED',
        self::AUDIO => 'AUDIO',
        self::VIDEO => 'VIDEO',
    ];

    public static function name($value)
    {
        if (!isset(self::$valueToName[$value])) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no name defined for value %s', __CLASS__, $value));
        }
        return self::$valueToName[$value];
    }


    public static function value($name)
    {
        $const = __CLASS__ . '::' . strtoupper($name);
        if (!defined($const)) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no value defined for name %s', __CLASS__, $name));
        }
        return constant($const);
    }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(OriginalMediaType::class, \Google\Cloud\Speech\V1\RecognitionMetadata_OriginalMediaType::class);
