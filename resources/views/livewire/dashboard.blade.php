<?php

use function Livewire\Volt\{state, computed};
use App\Models\User;
use Illuminate\Support\Facades\Auth;

state([
    'user' => fn() => Auth::user(),
    'currentWeight' => fn() => 0, // TODO: 最新の体重を取得
    'targetWeight' => fn() => 0, // TODO: 目標体重を取得
]);

$bmi = computed(function () {
    if (!$this->user->height || !$this->currentWeight) {
        return 0;
    }
    $heightInMeters = $this->user->height / 100;
    return round($this->currentWeight / ($heightInMeters * $heightInMeters), 1);
});

$progress = computed(function () {
    if (!$this->targetWeight || !$this->currentWeight) {
        return 0;
    }
    $total = abs($this->user->initial_weight - $this->targetWeight);
    $current = abs($this->user->initial_weight - $this->currentWeight);
    return min(100, round(($current / $total) * 100));
});

?>

<div class="p-4 sm:p-6 lg:p-8">
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <!-- 現在の体重カード -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">現在の体重</h2>
            <p class="text-3xl font-bold text-indigo-600">{{ $currentWeight }} kg</p>
            <p class="text-sm text-gray-500 mt-2">目標: {{ $targetWeight }} kg</p>
        </div>

        <!-- BMIカード -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">BMI</h2>
            <p class="text-3xl font-bold text-indigo-600">{{ $this->bmi }}</p>
            <p class="text-sm text-gray-500 mt-2">身長: {{ $user->height ?? '未設定' }} cm</p>
        </div>

        <!-- 進捗カード -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">目標達成進捗</h2>
            <div class="relative pt-1">
                <div class="overflow-hidden h-4 text-xs flex rounded bg-indigo-200">
                    <div style="width: {{ $this->progress }}%"
                        class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-indigo-500">
                    </div>
                </div>
                <p class="text-right mt-2">{{ $this->progress }}%</p>
            </div>
        </div>
    </div>

    <!-- 体重推移グラフ -->
    <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">体重推移</h2>
        <div class="h-64">
            <!-- TODO: グラフコンポーネントを実装 -->
            <p class="text-gray-500 text-center py-20">グラフ実装予定</p>
        </div>
    </div>
</div>
