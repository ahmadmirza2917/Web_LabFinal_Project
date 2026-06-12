<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ai_interactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['symptom_checker', 'chatbot', 'report_summary', 'prescription_explain', 'health_risk']);
            $table->text('input');
            $table->text('response');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('ai_interactions'); }
};